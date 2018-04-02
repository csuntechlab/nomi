<template>
    <div class="img--circle">
        <img :id="this.name+'-img'" :src="this.image" class="img--circle grid-image" name="photo">
    </div>
</template>

<script>
    export default {
        props: [
            'image',
            'name'
        ]
    }
</script>