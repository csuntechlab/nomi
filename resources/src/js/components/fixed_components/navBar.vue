<template>
    <nav class="primary-nav">
        <back-button></back-button>
        <div>
            <img class="logo" :src="this.url + '/images/csun_logo.svg'" alt="CSUN Logo">
            <span class="sr-only">California State University, Northridge (CSUN)</span></div>
        <div class="primary-nav__sub-brand subbrand_center">NOMI    </div>
    </nav>
</template>

<script>
    export default {
        data: function () {
          return {
              url: ''
          }
        },
        created: function () {
            this.url = document.querySelector('meta[name=app-url]').content;
        },
        beforeCreate(){
            this.$store.dispatch('getData');
        },
    }
</script>
