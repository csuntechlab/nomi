import { mapGetters } from 'vuex';
export const displayCurrentTerm = {
    data() {
        return {
              displayedTerm: '',
        }
      },
      computed: {
        ...mapGetters([
          'term'
        ]),
        displayCurrentTerm() {
            if (this.term != null) {
            const termCode = this.term;
            switch (termCode.charAt(3)) {
                case '3':
                this.displayedTerm = 'Spring';
                break;
                case '5':
                this.displayedTerm = 'Summer';
                break;
                case '7':
                this.displayedTerm = 'Fall';
                break;
                case '9':
                this.displayedTerm = 'Winter';
            }
            if (termCode.charAt(0) == '2') {
                this.displayedTerm
                            += ` ${
                            termCode.charAt(0)
                            }0${
                            termCode.substring(1, 3)}`;
            } else {
                this.displayedTerm
                            += ` ${
                            termCode.charAt(0)
                            }9${
                            termCode.substring(1, 3)}`;
            }
            return this.displayedTerm;
            }
        },
    }
}