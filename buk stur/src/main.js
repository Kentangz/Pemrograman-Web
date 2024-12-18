import { createApp } from 'vue';
import './style.css'
import App from './App.vue';
import router from './router'
import 'bootstrap/dist/css/bootstrap.min.css';


//create App Vue 
const app = createApp(App); 
 
//gunakan "router" di Vue dengan plugin "use" 
app.use(router); 
 
app.mount('#app'); 
