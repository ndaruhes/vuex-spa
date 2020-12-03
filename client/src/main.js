import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import VueToasted from 'vue-toasted'
import '@fortawesome/fontawesome-free/js/all'
import titleMixin from './mixins/titleMixin'
import VueProgressBar from 'vue-progressbar'
import CKEditor from '@ckeditor/ckeditor5-vue2';

export const bus = new Vue();

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';
// axios.defaults.baseURL = 'api.available.digitalinteraktif.com/api';
window.$ = window.jQuery = require('jquery');

require('@/store/subscriber')
require('bootstrap');
require('overlayscrollbars');
require('admin-lte');

Vue.config.productionTip = false
Vue.mixin(titleMixin)
Vue.use(VueToasted)
Vue.use(CKEditor)
const progressOption = {
  color: '#e67e22',
  failedColor: 'red',
  height: '2px'
}
Vue.use(VueProgressBar, progressOption)

store.dispatch('auth/attempt', localStorage.getItem('token')).then(() => {
  new Vue({
    router,
    store,
    render: h => h(App)
  }).$mount('#app')
})