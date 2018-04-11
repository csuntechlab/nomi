<template>
    <div>
        <button @click="updateImageHandler(image_type)">Choose Default Image</button>
    </div>
</template>
<script>
    export default {
        name: "image-handler",

        props: ['image_type'],

        methods: {
            updateImageHandler (first) {
                switch (first) {
                    case 'likeness':
                        this.$store.dispatch('updateImagePriority', {image_priority: 'likeness,avatar,official'})
                            .then(() => this.$store.dispatch('getData'));
                        break;
                    case 'avatar':
                        this.$store.dispatch('updateImagePriority', {image_priority: 'avatar,likeness,official'})
                            .then(() => this.$store.dispatch('getData'));
                        break;
                    case 'official':
                        this.$store.dispatch('updateImagePriority', {image_priority: 'official,likeness,avatar'})
                            .then(() => this.$store.dispatch('getData'));
                        break;
                    default:
                        console.log("oops");
                }
            }
        }
    }

</script>