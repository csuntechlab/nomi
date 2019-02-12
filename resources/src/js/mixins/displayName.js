export const displayName = {
	computed: {
        display_name() {
            return `${ this.check_name_exists(this.student.first_name, false) } ${ this.check_name_exists(this.student.last_name[0], true) }`;
        },
	},

	methods: {
		check_name_exists(name, isAbbreviation) {
			if (name === undefined || name === null) {
				return "";
			} else if (isAbbreviation) {
				return name + '.';
			} else {
				return name;
			}
		},
	},
}