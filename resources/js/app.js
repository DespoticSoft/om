import './bootstrap';
import Vue from 'vue';

import Routes from './routes';
import App from './views/App';
import Vuetify from "vuetify";
Vue.use(Vuetify);
import "vuetify/dist/vuetify.min.css";


const app = new Vue({
    el: '#app',
    router: Routes,
    vuetify: new Vuetify(),
    render: h=> h(App),
});
export default app;
