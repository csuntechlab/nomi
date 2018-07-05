<template>
    <div>
        <img :id="this.name+'-img'" :src="this.image" class="profile_padding img--circle col-md-12 col-xs-12" name="photo">
    </div>
</template>

<script>
    export default {
        name: 'profile-picture',
        props: [
            'image',
            'name'
        ]
    }
</script>