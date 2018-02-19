<template>
<div class="grid-image">
        <img :src="studentImage" class="img--circle" name="photo" accept="image/*">
</div>

</template>
<script>
    export default {
        props:['studentImage']
    }
</script>
<style scoped>
    img {
        height: 100%;
        width: 100%;
    }
</style>