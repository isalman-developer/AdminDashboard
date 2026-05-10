// Import axios (library for making HTTP requests)
import axios from 'axios';

// Make axios available everywhere in our app
window.axios = axios;

// Configure axios defaults
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Set base URL for all API calls
// Now we can write axios.get('/tasks') instead of axios.get('http://localhost:8000/api/tasks')
window.axios.defaults.baseURL = '/api';

// Send cookies with requests (needed for authentication)
window.axios.defaults.withCredentials = true;