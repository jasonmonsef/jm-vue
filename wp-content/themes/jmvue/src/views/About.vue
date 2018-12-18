<template>
  <div class="about" v-if="post">
    <!-- <img src="../assets/rcm-brand-logo.png"> -->
    
    <div class="page-wrap">
      <div class="banner" >
          <img :src="post.acf.banner.url" alt="">
          <div class="caption">{{post.acf.banner_caption}}</div>
      </div>
      <div class="inner-wrap">
       
        <div class="page-details" key="t-2" v-if="post" >
          <h1>about me</h1>
          <div class="page-content" v-html="post.content.rendered ">
             
          </div>
        </div>

        <aboutComp/>

      </div>
    </div>
  </div>
</template>
<script>
// @ is an alias to /src
import axios from 'axios'
import VueAxios from 'vue-axios'
import $ from "jquery";

import aboutComp from '../components/about_comp.vue'


export default {
  name: 'about',
  components: {
    aboutComp
  },
  data() {
        return {
            show: true,
            post:""
        };
    },
  props: ["postID", "postSlug"],
  beforeCreate: function() {
    document.body.className = 'inner-page';
  },
  mounted() {
    
var vm = this;


     var getPageID = this.$route.params.postID;
    if (getPageID !== undefined && getPageID !== null) {
      var routePageID = getPageID
    } else {
      var routePageID = global_page_id
    }

  /*  axios.get(root_site_path + '/wp-json/wp/v2/portfolio/' + routePageID).then(response => this.posts = response.data) .then(function (response) {
				
				console.log(response);
      });
 */
    function loadPage(){
      axios.get('http://localhost/jm-vue/wp-json/wp/v2/pages/36' ).then(response => vm.post = response.data).then(function (response) {
        console.log(response);
  		});
      
      //console.log(response);
    }
    loadPage();
      
      
  }

}
</script>

<style scoped lang="scss">
.page-wrap {padding-top:100px}
.page-wrap .inner-wrap {max-width:1200px;margin:0 auto;padding: 0 20px 60px;}

h1 {color:#000;margin-bottom: 70px}
.banner {position: relative;margin-bottom:70px}
.banner img {width: 100%;height: auto}
.banner .caption {
	position: absolute;
	color: rgb(255, 255, 255);
	bottom: 10px;
  right: 6%;
  font-size: 36px;
  margin-bottom: 20px;
  font-weight: bold;
  font-family: oswald
}

</style>