window.SETTINGS = {
  // How many different dispatched actions determine loading progress
  // This is likely determined by how many dispatched actions you have below
  // in the created() method
  LOADING_SEGMENTS: 2,
  API_BASE_PATH: '/jm-vue/wp-json/wp/v2/'
}


import 'babel-polyfill'
import Vue from 'vue'
import App from './App.vue'
import router from './router.js'
import VueLazyload from 'vue-lazyload'
import VueQrcodeReader from 'vue-qrcode-reader'
import axios from 'axios'
import VueAxios from 'vue-axios'
import $ from "jquery";


Vue.use(VueQrcodeReader)
//Vue.use(VueAxios, axios)

// const HelloJs = require('hellojs/dist/hello.all.min.js');
// const VueHello = require('vue-hellojs');
//import './registerServiceWorker'

Vue.config.productionTip = false
Vue.use(VueLazyload)


// HelloJs.init({
//   google:  '829548674032-uthu7793om5dcua11fd73liaer7vgdqf.apps.googleusercontent.com' ,
//   facebook: '461932777641788'
// }, {
//   redirect_uri: 'authcallback/'
// });
// Vue.use(VueHello, HelloJs);
const myMixin = {
  mounted: function () {
  //   $(window).scroll(function (event) {
  //     var scroll = $(window).scrollTop();
  //     $('.top-header-wrap').toggleClass('active',
  //      //add 'ok' class when div position match or exceeds else remove the 'ok' class.
  //       scroll >= $('#hero-banner').offset().top
  //     );
  // });
  // //trigger the scroll
  // $(window).scroll();//ensure if you're in current position when page is refreshed


  $(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 100) {
        $(".top-header-wrap").addClass("active");
    } else {
        $(".top-header-wrap").removeClass("active");
    }
});
  
  }
  
  
}
new Vue({
  router,
  render: h => h(App),
  mixins: [myMixin]

}).$mount('#app')
