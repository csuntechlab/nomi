import moment from 'moment'
export const refetchImage = {
    mounted() {
		if (this.editable) {
            this.$children[0].$el.childNodes[0].src = "./images/profile-loading.gif"
			this.$children[0].$el.childNodes[0].src = this.image + '&timestamp=' + moment().format('DDhmmss');
		}
	}
}
