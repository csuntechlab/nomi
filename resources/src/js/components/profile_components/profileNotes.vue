<template>
    <div>
        <textarea class="notes_text" type="text" id="ex0" name="ex0" :value="this.student.notes" @input="updateNotes" @keyup.enter="updateNotes"></textarea>
        <div class="type--right">
            <span v-if="characterCount<601">
                <span v-if="noteSaved" class="notes_status">Notes Saved!</span>
                <span v-if="unsavedChanges" class="notes_status">Unsaved changes.</span>
                <button class="btn btn-sm btn-default" @click.prevent="commitNotes">Save Notes</button>
            </span>
            <span v-if="characterCount>600" id="charCount" class="notes_counter">{{characterCount}}/600</span>
        </div>
    </div>
</template>
<script>
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

	mounted() {
		this.resizeNotes();
	},

	methods: {
		updateNotes(e) {
			this.resizeNotes();
			this.$store.dispatch("updateNotes", e.target.value).then(() => {
				this.noteSaved = false;
				this.unsavedChanges = true;
			});
		},
		commitNotes() {
			if (this.characterCount < 601) {
				this.$store.dispatch("commitNotes").then(() => {
					this.noteSaved = true;
					this.unsavedChanges = false;
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
			return this.student.notes.length;
		}
	}
};
</script>