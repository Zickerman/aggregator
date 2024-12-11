import './bootstrap';
import { createApp } from 'vue';
import LinksTable from './components/LinksTable.vue';

const app = createApp({});
app.component('links-table', LinksTable);
app.mount('#admin-app');
