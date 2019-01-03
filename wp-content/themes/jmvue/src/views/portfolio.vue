<template>
  <div class="page-wrap">
    <div class="banner" >
        <img src="../assets/code2.jpg" alt="">
        <div class="caption"></div>
      </div>
    <div id="showcase">
     <div class="inner-wrap">
      <h1>portfolio</h1>  
      <div class="post-list-wrap" ref="criteria" v-waypoint="{ active: true, callback: onWaypoint, options: intersectionOptions }"> 
        
    	  <div class="single-post" v-for="post in posts" :key="post.id" :style="{ 'background-image' : 'url(\'' +    post.acf.big_screenshot.sizes.medium_large + '\')' }">
        
          <div class="featured-overlay">
    	    	<h3>{{ post.title.rendered }}</h3>
    	    	<router-link :to="{ name: 'portfolio-single' , params: { postID: post.id, postSlug: post.slug }}">
              view more
            </router-link>
    	    </div>
    		</div><!-- single-post -->

    	</div><!-- post-list-wrap -->
      </div><!-- .inner-wrap -->
    </div><!-- #showcase -->

    
  </div><!-- .page-wrap -->
</template>
<script>
// @ is an alias to /src
import axios from 'axios'
import VueAxios from 'vue-axios'
import $ from "jquery";

export default {
  name: "portfolio",
  data() {
        return {
            show: true,
            posts:[],
            intersectionOptions: {
            root: null,
            rootMargin: '0px 0px 0px 0px',
            thresholds: 0
          } 
        }
    },
   mounted: function () {
    //  $("#hero-banner,.home").addClass("omgwtfbbq");
   },
  beforeCreate: function() {
    document.body.className = 'inner-page';
  },

created() {
    var vm = this;
    function loadPageData(){
      axios.get('/jm-vue/wp-json/wp/v2/portfolio?order=asc').then(response => vm.posts = response.data).then(function (response) {
        console.log(response);
  		});
      
      //console.log(response);
    }
    loadPageData();

  
  
},
 methods: {
    onWaypoint ({ going, direction }) {
      // going: in, out
      // direction: top, right, bottom, left
      var element = this.$refs.criteria.className;

      if (going === this.$waypointMap.GOING_IN) {
        console.log('waypoint going in!')
        document.getElementsByClassName(element)[0].classList.remove("hullaballoo");
        //element.classList.add("mystyle");
      }
 
      if (direction === this.$waypointMap.DIRECTION_TOP) {
        console.log('waypoint going top!')
        document.getElementsByClassName(element)[0].className += " hullaballoo";
        
      }
    }
  }
};
</script>


<style scoped lang="scss">
.banner img {width:100%;height: auto;}
#showcase {

  margin-bottom: 120px;

  .post-list-wrap {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-gap:30px;
    padding:0;
  }
  .single-post  {
  	background-size: cover;
  	background-repeat: no-repeat;
  	background-position: center top;
  	background-size: cover !important;
  	border: 10px solid #f3f3f3;
  	min-height: 343px;
  	padding: 0px;
  	position: relative;
  	text-align: center;
    transition: all 0.3s ease 0s;
    display:flex;
    
    h3 {
      margin-bottom:30px;
      font-weight: bold;
      font-size:21px
    }

     a {
    	color: #fff;
    	text-decoration: none;
    	border: 1px solid #fff;
    	display: inline-block;
    	padding: 10px 20px;
    }
  }

 
  .single-post:hover .featured-overlay {
  	background: none repeat scroll 0 0 rgba(0, 0, 0, 0.75);
  	bottom: 0;
  	color: #fff;
  	opacity: 1;
  	padding: 5% 0;
  	transition: all 0.3s ease 0s;
    margin-top:auto;
  }
  .featured-overlay {
    width:100%;
    margin-top:auto;
    opacity: 0;
    bottom:0;
    transition: all 0.3s ease 0s;
  }

}
</style>
