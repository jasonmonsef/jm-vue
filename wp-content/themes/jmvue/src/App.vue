<template>
  <div id="app">
     <transition name="fade" appear>
    <div class="top-header-wrap" v-bind:class="{ 'mobile-menu-active': isActive }">
      <div class="inner-wrap">
        <div class="logo">
          <router-link to="/jm-vue"></router-link>
        </div><!-- logo -->
        <div class="hamburger hamburger--3dx" v-on:click="myFilter"  v-bind:class="{ 'is-active': isActive }">
          <div class="hamburger-box">
            <div class="hamburger-inner"></div>
          </div>
        </div>
        <div class="nav" v-bind:class="{ 'is-active': isActive }">
          <ul>
            <li><router-link v-on:click.native="myFilter" to="/jm-vue/about">about</router-link></li>
            <li><router-link v-on:click.native="myFilter" to="/jm-vue/portfolio">portfolio</router-link></li>
            <li><router-link v-on:click.native="myFilter" to="/jm-vue/contact">contact</router-link></li>
          </ul>
        </div>
      </div>
    </div><!-- top-header-wrap -->
    </transition>

    <transition name="pageTransition">
      <router-view class="view" ></router-view>
    </transition>

    


  </div><!-- app -->

</template>

<script>

export default {
  data() {
        return {
          isActive: false,
          closeMenu: false
        }
  },
  methods: { 
    myFilter: function(){
      this.isActive = !this.isActive;
    // some code to filter users
    },
    mySecondFilter: function(){
      console.log("mySecondFilter fired");
      this.isActive = !this.isActive;
      if (this.isActive = !this.isActive) {
       document.getElementsByClassName("hamburger").remove('is-active')
      }
    // some code to filter users
    }
  }
}
</script>

<style lang="scss" >
  @import './styles/app.scss';

.top-header-wrap.mobile-menu-active {
	height: 100vh;
	align-items: flex-start;
  background: rgba(0,0,0,.9);
  
  
}
 .top-header-wrap .inner-wrap {
    display:flex;
    flex-wrap:wrap;
    justify-content: space-between; 
    width: 100% 
  } 
  /*!
 * Hamburgers
 * @description Tasty CSS-animated hamburgers
 * @author Jonathan Suh @jonsuh
 * @site https://jonsuh.com/hamburgers
 * @link https://github.com/jonsuh/hamburgers
 */
.hamburger {
  padding: 15px 15px;
  display: none;
  cursor: pointer;
  transition-property: opacity, filter;
  transition-duration: 0.15s;
  transition-timing-function: linear;
  font: inherit;
  color: inherit;
  text-transform: none;
  background-color: transparent;
  border: 0;
  margin: 0;
  overflow: visible; }
  .hamburger:hover {
    opacity: 0.7; }
  .hamburger.is-active:hover {
    opacity: 0.7; }
  .hamburger.is-active .hamburger-inner,
  .hamburger.is-active .hamburger-inner::before,
  .hamburger.is-active .hamburger-inner::after {
    background-color: #fff; }

.hamburger-box {
  width: 40px;
  height: 24px;
  display: inline-block;
  position: relative; }

.hamburger-inner {
  display: block;
  top: 50%;
  margin-top: -2px; }
  .hamburger-inner, .hamburger-inner::before, .hamburger-inner::after {
    width: 40px;
    height: 4px;
    background-color: #000;
    border-radius: 4px;
    position: absolute;
    transition-property: transform;
    transition-duration: 0.15s;
    transition-timing-function: ease; }
  .hamburger-inner::before, .hamburger-inner::after {
    content: "";
    display: block; }
  .hamburger-inner::before {
    top: -10px; }
  .hamburger-inner::after {
    bottom: -10px; }

/*
   * 3DX
   */
.hamburger--3dx .hamburger-box {
  perspective: 80px; }

.hamburger--3dx .hamburger-inner {
  transition: transform 0.15s cubic-bezier(0.645, 0.045, 0.355, 1), background-color 0s 0.1s cubic-bezier(0.645, 0.045, 0.355, 1); }
  .hamburger--3dx .hamburger-inner::before, .hamburger--3dx .hamburger-inner::after {
    transition: transform 0s 0.1s cubic-bezier(0.645, 0.045, 0.355, 1); }

.hamburger--3dx.is-active .hamburger-inner {
  background-color: transparent !important;
  transform: rotateY(180deg); }
  .hamburger--3dx.is-active .hamburger-inner::before {
    transform: translate3d(0, 10px, 0) rotate(45deg); }
  .hamburger--3dx.is-active .hamburger-inner::after {
    transform: translate3d(0, -10px, 0) rotate(-45deg); }

    
@media screen and (max-width: 600px) {
  .nav {height:0;overflow: hidden;transition: all 0.3s ease 0s;flex: 1 1 auto;width:100%}
  .nav.is-active {
    display: block;
    flex: 1 1 auto;
    height: 30px;
    overflow: visible;
    transition: all 0.3s ease 0s;
    padding: 0;
    margin-top: 100px;
    margin-left: 0;
    width: 100%;

    ul {justify-content: center;flex-direction: column}
    li {font-size: 25px;margin-bottom: 50px;}
  }
  .hamburger {display:inline-block;}
  
  .logo a {
    	width: 208px;
    	height: 61px;
    	-webkit-transition: all 0.3s ease 0s;
    	transition: all 0.3s ease 0s;
    }
    #resume {column-count: 1;}
}
</style>  