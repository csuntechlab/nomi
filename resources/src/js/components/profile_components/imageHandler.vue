<template>
    <div v-if="studentProfile.imagePriority === image_type">
        <button class="btn btn-default text-overflow">Default Set <i class="fas fa-check"/></button>
    </div>
    <div v-else>
        <button id="setDefaultBtn" class="btn btn-default text-overflow" @click.prevent="updateImageHandler">Set Default</button>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        name: 'image-handler',

        props: ['image_type'],

        computed: {
            ...mapGetters([
                'studentProfile',
                'facultyMember',
                'term'
            ])
        },

        methods: {
            updateImageHandler() {
                document.getElementById("setDefaultBtn").innerHTML= 'Setting Default...'
                this.$store.dispatch(
                    'updateStudentPriority',
                    {
                        student_id: this.studentProfile.id,
                        image_priority: this.image_type,
                    }
                );
                this.$store.dispatch(
                    'updateImagePriority',
                    {
                        student_id: this.studentProfile.id,
                        image_priority: this.image_type,
                        faculty_id: this.facultyMember.id.replace("members:", ""),
                        term: this.term,
                    }
                );
            }
        }
    }
</script>
