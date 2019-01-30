export const getImage = {
    computed: {
        image() {
            let secret= document.querySelector('meta[name=secret-url]').content;
            let imageRoute = document.querySelector('meta[name=img-url]').content + `${this.student.email_uri}` + '/' + `${this.student.image_priority}` + secret + `${this.student.timestamp}`;
            return imageRoute;
        },
    }
}
