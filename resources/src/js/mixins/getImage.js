export const getImage = {
    computed: {
        image() {
            let imageRoute = "https://api.sandbox.csun.edu/metalab/test/media/1.1/student/media/" + `${this.student.email_uri}`+ '/' +`${this.student.image_priority}` + '?secret=IUEdtASs7sdiCZBe7Phb/26ilx8PyWr6N4vk8r59KSE019TgsFiBb19wKAxLnwGlbOENrRikSSi5NgqDOTsftw=='
            return imageRoute;
        },
    }
}