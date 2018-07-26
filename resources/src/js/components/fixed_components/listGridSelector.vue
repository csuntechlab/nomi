<template>
    <div>
        <label for="list-grid"></label>
            <div v-if="this.list">
                <select class="toolBar__field" name="list-grid" id="list-grid" @input="handleSelect">
                    <option value="0" selected>List View</option>
                    <option value="1">Gallery</option>
                    <option value="2">Flash Cards</option>
                </select>
            </div>
            <div v-else-if="this.flash">
                <select class="toolBar__field" name="list-grid" id="list-grid" @input="handleSelect">
                    <option value="0">List View</option>
                    <option value="1">Gallery</option>
                    <option value="2" selected>Flash Cards</option>
                </select>
            </div>
            <div v-else>
                <select class="toolBar__field" name="list-grid" id="list-grid" @input="handleSelect">
                    <option value="0">List View</option>
                    <option value="1" selected>Gallery</option>
                    <option value="2">Flash Cards</option>
                </select>
            </div>

    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: "list-grid-selector",

    computed: {
        ...mapGetters([
            'list',
            'flash'
        ])
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
        },
    }
}
</script>
