export const setStudent = {
    methods: {
        setStudent() {
            this.$store.dispatch('setStudent', {
                student_id: this.student.student_id,
                email: this.student.email,
                email_uri: this.student.email_uri,
                first_name: this.student.first_name,
                last_name: this.student.last_name,
                display_name: this.student.display_name,
                images: this.student.images,
                image_priority: this.student.image_priority
            });
        }
    }
}