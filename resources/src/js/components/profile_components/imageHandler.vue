<template>
    <div v-if="this.studentProfile.imagePriority === image_type">
        <button class="btn btn-default textOverflow" @click="updateImageHandler">Default Set <i class="fas fa-check"/></button>
    </div>
    <div v-else>
        <button class="btn btn-default textOverflow" @click="updateImageHandler">Set Default</button>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "image-handler",

        props: ['image_type'],

        computed: {
            ...mapGetters([
                'studentProfile',
                'facultyMember'
            ])
        },

        methods: {
            updateImageHandler() {
                this.$store.dispatch(
                    'updateImagePriority',
                    {
                        image_priority: this.image_type,
                        faculty_id: this.facultyMember.id,
                    }
                ).then(() => {
                    this.$store.dispatch('getOnlyData')
                });

            }
        }
    }
</script>