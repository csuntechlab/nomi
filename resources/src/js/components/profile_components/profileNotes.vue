<template>
    <div>
        <textarea class="notes_text" maxlength="600" type="text" id="ex0" name="ex0" :value="this.student.notes" @input="updateNotes" @keyup.enter="updateNotes"></textarea>
        <div>
            <span class="pull-right">
                <button class="btn btn-sm btn-default" @click.prevent="commitNotes">Save Notes</button>
            </span>
			<span id="charCount" class="notes_status pull-left">{{characterCount}}/600</span>
        </div>
    </div>
</template>
<script>
import modal from "../fixed_components/modal.vue"
export default {
	name: "profile-notes",

	props: ["student"],

	data: function() {
		return {
			unsavedChanges: false,
			noteSaved: false,
			showEmail: false
		};
	},

	components: {
		modal
	},

	mounted() {
		this.resizeNotes();
	},

	methods: {
		updateNotes(e) {
			this.resizeNotes();
			this.$store.dispatch("updateNotes", e.target.value).then(() => {
				this.noteSaved = false;
				this.unsavedChanges = true;
				this.$emit('unsavedChanges');
			});
		},
		commitNotes() {
			if (this.unsavedChanges == true) {
				this.$store.dispatch("commitNotes").then(() => {
					this.noteSaved = true;
					this.unsavedChanges = false;
					this.$emit('committedChanges');
				});
			}
		},
		resizeNotes() {
			let size = document.querySelector("#ex0").scrollHeight;
			document.getElementById("ex0").style.height = size + "px";
		}
	},
	computed: {
		characterCount() {
			if(this.student.notes != null){
				return this.student.notes.length;
			}
		},
	}
};
</script>