<template>
    <div>
        <div id="mySidenav" class="sidenav">
            <a href="" class="closebtn" @click.prevent="closeNav()">&times;</a>
            <a href="#">Profile</a>
            <a href="#">Game</a>
            <a href="#">Settings</a>
            <a href="/logout">Logout</a>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            openNav: function(event) {
                document.getElementById("mySidenav").style.width = "100vw";
            },

            closeNav: function(event) {
                document.getElementById("mySidenav").style.width = "0";
            }
        }
    }
</script>