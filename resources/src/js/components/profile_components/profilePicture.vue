<template>
    <div>
        <img :id="this.name+'-img'" :src="this.image" class="profile_padding img--circle img--fluid" name="photo">
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