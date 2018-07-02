<template>
    <nav class="primary-nav">
        <back-button></back-button>
        <div class="logo_parent">
            <img class="csun_logo" :src="this.url + '/images/csun_logo.svg'" alt="CSUN Logo">
            <span class="sr-only">California State University, Northridge (CSUN)</span>
            <img class="nomi_logo" :src="this.url + '/images/nomi.svg'">
        </div>
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
    }
</script>
