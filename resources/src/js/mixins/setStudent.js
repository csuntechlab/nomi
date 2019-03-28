export const setStudent = {
    methods: {
        setStudent() {
            this.$store.dispatch('getStudent', {
                student_id: this.student.student_id,
                email: this.student.email,
                email_uri: this.student.email_uri,
                first_name: this.student.first_name,
                last_name: this.student.last_name,
                display_name: this.student.display_name,
                profile_image: this.student.profile_image
            });
        }
    }
}