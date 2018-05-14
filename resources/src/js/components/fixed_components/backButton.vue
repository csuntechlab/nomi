<template>
    <router-link :to="destination">
        <i class="fa fa-arrow-left fa-3x type--center" title="Go Back"></i>
    </router-link>
</template>

<script>
    export default {
        name: "back-button",

        props: ['destination']
    }
</script>