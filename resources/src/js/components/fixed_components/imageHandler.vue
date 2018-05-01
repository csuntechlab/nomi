<template>
    <div v-if="sp_image_priority === image_type">

    </div>
    <div v-else>
        <button class="btn btn-default" @click="updateImageHandler">Make Default Image</button>
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
            },

           

        }
    }
</script>