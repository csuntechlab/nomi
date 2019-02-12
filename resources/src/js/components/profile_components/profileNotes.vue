<template>
	<div>
		<form autocomplete="off">
			<textarea :placeholder="'Write about ' + this.student.firstName + '.'" class="notes_text" maxlength="600" type="text" id="ex0" name="ex0" :value="this.student.notes" @input="updateNotes" @keyup.enter="updateNotes" @click="scrollToNotes"></textarea>
		</form>
		<div class="row">
			<div class="col-xs-2">
				<span v-if="this.student.notes == null" id="charCount" class="notes__status">0/600</span>
				<span v-else id="charCount" class="notes__status">{{characterCount}}/600</span>
			</div>
			<div class="col-xs-10 type--right">
				<span v-show="this.unsavedChanges" class="notes__status notes__status--italic">Unsaved Changes</span>
				<span v-show="this.noteSaved" class="notes__status notes__status--italic">Changes Saved!</span>
				<button class="target-button btn btn-sm btn-default" @click.prevent="commitNotes">Save</button>
			</div>
		</div>
	</div>
</template>
<script>
	import modal from '../fixed_components/modal.vue';

	export default {
	  name: 'profile-notes',

	  props: ['student'],

	  data() {
    return {
      unsavedChanges: false,
      noteSaved: false,
      showEmail: false,
    };
  },

	  components: {
	    modal,
	  },

	  mounted() {
	    this.resizeNotes();
	  },

	  methods: {
	    updateNotes(e) {
	      this.resizeNotes();
	      this.$store.dispatch('updateNotes', e.target.value).then(() => {
	        this.noteSaved = false;
	        this.unsavedChanges = true;
	        this.$emit('unsavedChanges');
	      });
	    },
	    commitNotes() {
	      if (this.unsavedChanges == true) {
	        this.$store.dispatch('commitNotes').then(() => {
	          this.noteSaved = true;
	          this.unsavedChanges = false;
	          this.$emit('committedChanges');
	        });
	      }
	    },
	    resizeNotes() {
	      const size = document.querySelector('#ex0').scrollHeight;
	      document.getElementById('ex0').style.height = `${size}px`;
	    },
	    scrollToNotes() {
	      document.getElementById('ex0').scrollIntoView();
	    },
	  },
	  computed: {
	    characterCount() {
	      if (this.student.notes != null) {
	        return this.student.notes.length;
	      }
	    },
	  },
	};
</script>