<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\ListProductsRequest;
use App\Models\Product;
use GuzzleHttp;

class ProductController extends Controller
{
    private $client;

    function __construct() {
        $this->client = new GuzzleHttp\Client();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ListProductsRequest $request)
    {
        if (!Product::exists()) {
            $data = $this->fetchDataFromScrapping();
            $newProductsArray = $this->prepareNewProductsArray($data->products->hits);

            Product::insert($newProductsArray);
        }

        $type = $request->get('type');

        if ($type) {
            $productsFilteredFromType = Product::where('type', $type);
        }

        $page = $request->get('page') ?? 1;
        $productsPerPage = 30;
        
        if (isset($productsFilteredFromType)) {
            $products = $productsFilteredFromType->skip(($page - 1) * $productsPerPage)
                                                ->take($productsPerPage)
                                                ->get();
        } else {
            $products = Product::skip(($page - 1) * $productsPerPage)
                                ->take($productsPerPage)
                                ->get();
        }

        $filters = [
            'types' => array_map(function ($item) {
                return $item['type'];
            }, Product::distinct()->get('type')->toArray())
        ];

        return response()->json([
            'status' => true,
            'message' => 'Products list',
            'payload' => [
                'products' => $products,
                'filters' => $filters
            ]
        ], 200);
    }

    private function fetchDataFromScrapping()
    {
        $url = 'https://chicorei.com/acessorios/?per_page=120';
        $response = $this->client->request(
            'GET', 
            'https://' . $_ENV['RAPID_API_HOST'] . '/get?url=' . $url,
            [
                'headers' => [
                    'X-RapidAPI-Host' => $_ENV['RAPID_API_HOST'],
                    'X-RapidAPI-Key' => $_ENV['RAPID_API_KEY'],
                ],
            ]
        );

        $response_body = (string) $response->getBody();

        $start_products_token = '{"state":"vueProducts"';
        $start_products_position = strpos($response_body, $start_products_token);
        
        $end_products_token = ';var popListener=function(event)';
        $end_products_position = strpos($response_body, $end_products_token);
        
        $products_str = substr(
            $response_body,
            $start_products_position,
            $end_products_position - $start_products_position
        );

        $response_body_decoded = json_decode($products_str);

        return $response_body_decoded;
    }

    private function prepareNewProductsArray($products)
    {
        $newProductsArray = [];
        foreach ($products as $product) {
            $newProduct = new Product();
            $newProduct->name = $product->name;
            $newProduct->price = $product->price;
            $newProduct->price_old = $product->price_old ?? null;
            $newProduct->promo_name = $product->promo_name ?? null;
            $newProduct->img_cover = $product->img_cover;
            $newProduct->img_thumb = $product->img_thumb ?? null;
            $newProduct->type = $product->type->name;

            $newProductsArray[] = $newProduct->attributesToArray();
        }

        return $newProductsArray;
    }
}
