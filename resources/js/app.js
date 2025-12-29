// Import Vue framework
import { createApp } from 'vue';

// Import Pinia (state management)
import { createPinia } from 'pinia';

// Import our main Vue component
import App from './src/App.vue';

// Import router (navigation)
import router from './src/router';

// Import axios configuration
import './bootstrap';

// Create Vue application instance
const app = createApp(App);

// Create Pinia instance (for managing shared data)
const pinia = createPinia();

// Tell Vue to use Pinia
app.use(pinia);

// Tell Vue to use Router
app.use(router);

// Mount (attach) Vue app to HTML element with id="app"
app.mount('#app');
