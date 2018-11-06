export const getStudent = {
    methods: {
        getStudent() {
            this.$store.dispatch('getStudent', {studentID: this.student.student_id, email: this.student.email, first_name: this.student.first_name, last_name: this.student.last_name})
        }
    }
}