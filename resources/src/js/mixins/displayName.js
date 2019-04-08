export const displayName = {
	computed: {
        display_name() {
            return `${ this.check_name_exists(this.student.first_name) } ${ this.check_name_exists(this.student.last_name) }`;
        },
	},

	methods: {
		check_name_exists(name) {
			if (name === undefined || name === null) {
				return "";
			} else if (name.length === 1) {
				return name + '.';
			} else {
				return name;
			}
		},
	},
}