<template>
    <body class="off-white">
        <div class="container">
            <courses-container></courses-container>
            <router-link :to="'/profile/'">
                Go to profile page
            </router-link>
        </div>
        <side-bar></side-bar>   
        <menu-bar></menu-bar>
    </body>
</template>

<script>
    export default {
        name: "home",
    }
</script>
