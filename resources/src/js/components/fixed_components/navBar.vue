<template>
    <nav id="primary-nav" class="primary-nav">
        <back-button></back-button>
        <div class="nav__header">
            {{this.displayCurrentTerm}}
        </div>
    </nav>
</template>

<script>
import { mapGetters } from "vuex";
import backButton from "./backButton.vue"
export default {
	data: function() {
		return {
			url: ""
		};
    },
    components: {
        backButton
    },
	created: function() {
		this.url = document.querySelector("meta[name=app-url]").content;
    },
    computed: {
        ...mapGetters([
            'term',
        ]),

        displayCurrentTerm() {
                if (this.term != null) {
                    let termCode = this.term;
                    switch (termCode.charAt(3)) {
                        case "3":
                            this.displayedTerm = "Spring";
                            break;
                        case "5":
                            this.displayedTerm = "Summer";
                            break;
                        case "7":
                            this.displayedTerm = "Fall";
                            break;
                        case "9":
                            this.displayedTerm = "Winter";
                    }
                    if (termCode.charAt(0) == "2") {
                        this.displayedTerm +=
                            " " + termCode.charAt(0) + "0" + termCode.substring(1, 3);
                    } else {
                        this.displayedTerm +=
                            " " + termCode.charAt(0) + "9" + termCode.substring(1, 3);
                    }
                    return this.displayedTerm;
                }
            }
    },
};

$(window).scroll(function() {
    if ($(document).scrollTop() > 145) {
        $('#primary-nav').addClass('shrink-nav');
    } else {
        $('#primary-nav').removeClass('shrink-nav');
    }
});
</script>
