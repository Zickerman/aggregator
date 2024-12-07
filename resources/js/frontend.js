import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import LinksTable from './components/LinksTable.vue';

const app = createApp(App);
app.component('links-table', LinksTable);
app.mount('#app');