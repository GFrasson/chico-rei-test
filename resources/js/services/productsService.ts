import axios from 'axios';

async function listProducts(page: string) {
  try {
    const response = await axios.get('/api/products', {
      params: {
        page
      }
    });
    
    return response.data.payload;
  } catch (err) {
    console.error(err);
  }
}

export { listProducts };
