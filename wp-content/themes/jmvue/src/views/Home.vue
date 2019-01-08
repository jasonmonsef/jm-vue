<template>
  <div class="home">
    <div id="hero-banner" >
      
	    <div class="message wow fadeIn" >
		    <h1>Jason Monsef</h1>
		    <h2>I breathe life into beautiful designs</h2>
      </div> <!-- .message -->
      <div class="button-next wow fadeIn">
	      <a href="#" class="smooth-anchor">Get to know me</a>
      </div>
      
    </div> <!-- #hero-banner -->


    <div id="intro-wrap">
      <div class="inner-wrap">
			  <div class="intro">
			  	<h2>Hi! I am a Frontend Developer specializing in Wordpress, Scalable Web Applications and E-Commerce</h2>
			  </div>
			  <div class="quick-links">
			  	<router-link :to="{ name: 'portfolio'}">View my work</router-link>
			  	<router-link :to="{ name: 'about'}">About me</router-link>
			  </div>
      </div>
		</div> <!-- #intro-wrap -->

    <div id="showcase">
      <div class="post-list-wrap">  
	      <div class="single-post" v-for="post in posts" :key="post.id"  :style="{ 'background-image' : 'url(\'' + post.acf.big_screenshot.sizes.medium_large + '\')' }">
          
            <div class="featured-overlay">
					  	<h3>{{ post.title.rendered }}</h3>
					  	<router-link :to="{ name: 'portfolio-single' , params: { postID: post.id, postSlug: post.slug }}">
                view more
              </router-link>
					  </div>
			    
		    </div><!-- single-post -->
	    </div><!-- post-list-wrap -->
    </div>

  </div><!-- home -->
</template>
<script>
// @ is an alias to /src
import axios from 'axios'
import VueAxios from 'vue-axios'
import $ from "jquery";

export default {
  name: 'home',
  data() {
        return {
            show: true,
            posts:[]
        };
    },
   mounted: function () {
    //  $("#hero-banner,.home").addClass("omgwtfbbq");
   },
  beforeCreate: function() {
    document.body.className = 'home';
  },

created() {
    var vm = this;
    function loadPageData(){
      axios.get('/jm-vue/wp-json/wp/v2/portfolio?order=asc&per_page=6').then(response => vm.posts = response.data).then(function (response) {
        console.log(response);
  		});
      
      //console.log(response);
    }
    loadPageData();

  
  
}

}
</script>

<style scoped lang="scss">

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
.blue {background:blue;width:100px;height:100px}
.green {background:green;width:100px; height: 100px;}

#intro-wrap .inner-wrap {
  display:flex;
  align-items:center;
  justify-content: space-between;
  padding:70px 30px;
  max-width:1200px;
  margin:0 auto;

  a {
    border: 3px solid #000;
    border-radius:5px;
  	color: #000;
  	display: inline-block;
  	font-weight: bold;
  	margin-bottom: 10px;
  	margin-right: 10px;
  	padding: 15px;
  	text-align: center;
  	width: 188px;
  	transition: all 0.3s ease 0s;
  	text-decoration: none;
  }

  a:hover {
  	background: #EB7F00;
  	color: #fff;
  	transition: all 0.3s ease 0s;
  	border: 3px solid #ccc;
  }
  
  .intro {
    margin-right:20px;
    width:65%
  }
  h2 {
    font-size:28px;
    line-height: 1.5em;
    margin: 0 0 20px 0;
    letter-spacing: 1px;
  }
  .quick-links {
    display:flex;
    justify-content: flex-end;
    width:35%
  }
  
  
}
#showcase {

  margin-bottom: 120px;

  .post-list-wrap {
    display: grid;
    grid-template-columns: auto auto auto;
    grid-gap:30px;
    padding:0 30px;
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

.omgwtfbbq {
  -webkit-animation: omgwtfbbq 2s ;
}

@-webkit-keyframes omgwtfbbq {
  // 0%, 100%  { -webkit-filter: blur(0px) brightness(none) hue-rotate(0deg) saturate(none); }
  50% { -webkit-filter: brightness(10) blur(10px) hue-rotate(180deg) saturate(10); }
}
@media screen and (max-width: 768px) {
  .home #hero-banner .message {padding-top: 24%}
}
@media screen and (max-width: 715px) {
  #intro-wrap .inner-wrap {flex-direction: column}
  #intro-wrap .inner-wrap .intro {width: 100%;text-align: center;}
  #intro-wrap .inner-wrap .quick-links {width:100%;justify-content: center}
  #showcase .post-list-wrap {grid-template-columns: repeat(2, 1fr)}
}
@media screen and (max-width: 465px) {

  .home #hero-banner .message {
  	padding-top: 34%;
  	flex-grow: 1;
  }

  .home #hero-banner h1 {
	  font-size: 54px;
	  text-align: center;
  }
  .home #hero-banner h2 {
	  font-size: 20px;
	  text-align: center;
  }
   #showcase .post-list-wrap {grid-template-columns: repeat(1, 1fr)}
}
</style>
