<template>
    <div>
        <img :id="this.name+'-img'" :src="this.image" class="clearPadding img--circle col-md-12 col-xs-12" name="photo">
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