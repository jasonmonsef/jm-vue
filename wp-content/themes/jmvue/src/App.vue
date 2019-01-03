<template>
  <div id="app">
     <transition name="fade" appear>
    <div class="top-header-wrap">
      <div class="logo">
        <router-link to="/jm-vue"></router-link>
      </div><!-- logo -->
      <div class="nav" v-once>
        <ul>
          <li><router-link to="/jm-vue/about">about</router-link></li>
          <li><router-link to="/jm-vue/portfolio">portfolio</router-link></li>
          <li><router-link to="/jm-vue/contact">contact</router-link></li>
        </ul>
      </div>
    </div><!-- top-header-wrap -->
    </transition>

    <transition name="pageTransition">
      <router-view class="view" ></router-view>
    </transition>

    


  </div><!-- app -->

</template>


<style lang="scss" >
  @import './styles/app.scss';
</style>  