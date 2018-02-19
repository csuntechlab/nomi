<template>

<nav class="primary-nav">
    <div class="primary-nav__mobile">
      <div class="primary-nav__btn" @click.prevent="openNav()">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
      <a href="www.csun.edu" class="primary-nav__brand"><span class="sr-only">California State University, Northridge (CSUN)</span></a>
       <a href="www.csun.edu" class="primary-nav__sub-brand">Nameface</a>
    </div>
    <ul class="primary-nav__links">
      <li><a class="primary-nav__link active" @click="openNav()">Menu</a></li>
    </ul>
</nav>

</template> 

<script>

 export default {
        methods: {
            openNav: function(event) {
                document.getElementById("mySidenav").style.width = "100vw";
            }

           
        }
    }

</script>