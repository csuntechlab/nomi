<template>
  <div>
      <router-view></router-view>
      <Home />
  </div>
</template>


<script>
    import Home from './views/home.vue';

    export default {
        name: "App"
    }
</script>


