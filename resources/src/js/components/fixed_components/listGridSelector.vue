<template>
    <div>
        <label for="list-grid"></label>
        <select name="list-grid" id="list-grid" @input="handleSelect">
            <option value="">Mode Select</option>
            <option value="0">List View</option>
            <option value="1">Gallery</option>
            <option value="2">Flash Cards</option>
        </select>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: "list-grid-selector",

    computed: {
        ...mapGetters([
            'list'
        ]),
    },

    methods: {
        handleSelect (e) {
            switch(e.target.value) {
                case "":
                    break;
                case "0":
                    this.$store.dispatch('setList');
                    break;
                case "1":
                    this.$store.dispatch('setGallery');
                    break;
                case "2":
                    this.$store.dispatch('setFlash');
                    break
            }
        }
    }
}
</script>
