<template>
  <div class="about" >
    
    
    <div class="single-post" v-if="post">
      <transition name="bounceInLeft" >
      <div class="preview-image"  v-if="post"   :style="{ 'background-image' : 'url(\'' + post.acf.big_screenshot.sizes.medium_large + '\')' }">
        
      </div>
      </transition>
      <transition name="pageTransitionSlow" mode="out-in" >
      <div class="project-details" key="t-2" v-if="post" >
        <h1>{{ post.acf.website_name }}</h1>
        <div class="tags" v-html="post.acf.statistic_box"></div>
        <div class="website-description" v-html="post.acf.website_description"></div>
        <div class="website-link">
          <a :href="post.acf.website_url" target="_blank">visit site</a>
        </div>
      </div>
        
  
      
    
     </transition>        
		</div><!-- single-post -->
    <div class="loadingPost" v-else>
        <div>
          <img src="../assets/three-dots.svg" alt="">
        </div>
      </div>
      
    

        <div class="button portfolio">
					  	
				<!-- 	<router-link :to="{ name: 'portfolio-single' , params: { postID: post.id, postSlug: post.slug }}">
            see more examples
          </router-link> -->
				</div>
			    
  </div>
</template>
<script>
// @ is an alias to /src
import axios from 'axios'
import VueAxios from 'vue-axios'
import $ from "jquery";

export default {
  name: 'portfolio-single',
  data() {
        return {
            show: true,
            post:"",
            isActive: false
        };
    },
  props: ["postID", "postSlug"],
  beforeCreate: function() {
    document.body.className = 'inner-page';
  },
  created() {

  var parts = current_page_url.split('/');
  var lastSegment = parts.pop() || parts.pop();
    console.log("last-seg= " + lastSegment);
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
    function loadPageItems(){
      if (routePageID == undefined){
          axios.get('http://localhost/jm-vue/wp-json/wp/v2/portfolio/?slug=' + lastSegment).then(response => vm.post = response.data).then(function (response) {
        console.log(response);
  		});
      } else {
        axios.get('http://localhost/jm-vue/wp-json/wp/v2/portfolio/' + routePageID).then(response => vm.post = response.data).then(function (response) {
        console.log(response);
  		  });
      }
      
      
      //console.log(response);
    }
    loadPageItems();
      
      
  }

}
</script>

<style scoped lang="scss">



.loadingPost {
  width:100%;
  height: 300px;
  display:flex;
  align-items: center;
  justify-content:center;

  img {display:block}
  

}
.about {padding:200px 40px 80px}
.inner-page h1 {color:#000;font-size:40px;margin-bottom:20px;}
.single-post {display:flex}

.website-description {
  margin-bottom:20px;
 
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-shadow: 1px 1px 1px rgba(0,0,0,0.05);
    text-rendering: optimizeLegibility;
    line-height: 26px;
      font-size: 18px;
 
}
.website-link {
  margin-bottom:50px;

  a {
	border: 1px solid #000;
	display: inline-block;
	padding: 10px 20px;
	color: #000;
  font-size: 17px;
  border-radius: 5px;
}
  
}

.preview-image {width:40%;height: 600px;background-size:cover;background-repeat:no-repeat;border: 5px solid #eaeaea;margin-right:30px}
.project-details {width:60%}
.tags {
	margin-bottom: 35px;
}
@media screen and (max-width: 600px) {
  .about {
	  padding: 130px 40px 80px;
  }
    .single-post {
        flex-direction: column-reverse;
    }
    .project-details {width:100%}
    .preview-image {width:100%}
    .website-link {text-align:center;}
    

}


</style>

