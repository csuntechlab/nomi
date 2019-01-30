export const getImage = {
    computed: {
        image() {
            let imageRoute = document.querySelector('meta[name=img-url]').content + `${this.student.email_uri}` + '/' + `${this.student.image_priority}` + '?secret=IUEdtASs7sdiCZBe7Phb/26ilx8PyWr6N4vk8r59KSE019TgsFiBb19wKAxLnwGlbOENrRikSSi5NgqDOTsftw==' + '&source=true'
            return imageRoute;
        },
    }
}
