<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
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
    public function index()
    {
        $data = $this->fetchDataFromScrapping();

        $products = $data->products->hits;
        $filters = $data->filters;

        return response()->json([
            'status' => true,
            'message' => 'Products list',
            'data' => [
                'products' => $products,
                'filters' => $filters
            ]
        ], 200);
    }

    private function fetchDataFromScrapping()
    {
        $url = 'https://chicorei.com/roupas?per_page=120';
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

        return $response_body_decoded ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
