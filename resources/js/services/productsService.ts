import axios from 'axios';

async function listProducts(page: number, type?: string) {
  try {
    const response = await axios.get('/api/products', {
      params: {
        page,
        ...(type && {
          type,
        })
      }
    });
    
    return response.data.payload;
  } catch (err) {
    console.error(err);
  }
}

export { listProducts };
