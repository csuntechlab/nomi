<template>
    <div>
        <button @click="openNav()">press for menu</button>
        <div id="mySidenav" class="sidenav">
            <a href="" class="closebtn" @click.prevent="closeNav()">&times;</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Clients</a>
            <a href="#">Contact</a>
        </div>
    </div>
</template>
<script>
    export default {
        methods: {
            openNav: function(event) {
                document.getElementById("mySidenav").style.width = "250px";
            },

            closeNav: function(event) {
                document.getElementById("mySidenav").style.width = "0";
            }
        }
    }
</script>