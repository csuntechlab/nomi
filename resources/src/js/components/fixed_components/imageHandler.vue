<template>
    <div v-if="sp_image_priority === image_type">
        <h2 class="type--center">Active Image</h2>
    </div>
    <div v-else class="type--center">
        <br>
        <button class="btn" @click="updateImageHandler">Choose Default Image</button>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "image-handler",

        props: ['image_type'],

        computed: {
            ...mapGetters([
                'sp_image_priority'
            ])
        },

        methods: {
            updateImageHandler() {
                this.$store.dispatch('updateImagePriority', {image_priority: this.image_type})
                    .then(() => this.$store.dispatch('getData'));
            }
        }
    }
</script>