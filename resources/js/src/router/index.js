// Import router tools from Vue Router
import { createRouter, createWebHistory } from 'vue-router';

// Import our Home page component
import Home from '../views/Home.vue';

// Define all routes (URLs) in our app
const routes = [
  {
    path: '/',           // URL: http://localhost:8000/
    name: 'Home',        // Name to reference this route
    component: Home,     // Which component to show
  },
  // We'll add more routes here later (Login, Dashboard, etc)
];

// Create router instance
const router = createRouter({
  history: createWebHistory(), // Use normal URLs (not #hash)
  routes,                       // Use our routes array
});

// Export so we can use it in app.js
export default router;