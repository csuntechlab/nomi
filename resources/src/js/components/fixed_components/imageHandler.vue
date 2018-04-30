<template>
    <div v-if="studentProfile.image_priority === image_type">
        <h2>This is the Active one</h2>
    </div>
    <div v-else>
        <button @click="updateImageHandler">Choose Default Image</button>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "image-handler",

        props: ['image_type'],

        computed: {
            ...mapGetters([
                'studentProfile'
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