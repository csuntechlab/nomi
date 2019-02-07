export const displayName = {
	computed: {
        display_name() {
            return `${ this.check_name(this.student.first_name) } ${ this.check_name(this.student.last_name[0]) }.`;
        },
	},

	methods: {
		check_name(name) {
			if (name === undefined || name === null) {
				return "";
			} else {
				return name;
			}
		},
	},
}