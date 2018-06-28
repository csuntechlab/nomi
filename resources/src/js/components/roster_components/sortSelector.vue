<template>
    <div v-if="!this.flash">
        <label for="name-sorting"></label>
        <select name="name-sorting" id="name-sorting" @input="handleSelect">
            <option value="1">First Name A-Z</option>
            <option value="2" selected>Last Name A-Z</option>
            <option value="3">First Name Z-A</option>
            <option value="4">Last Name Z-A</option>
        </select>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "sort-selector",

        computed: {
            ...mapGetters([
                'flash',
                'list',
                'sortDescending',
                'sortLastName'
            ])
        },

        methods: {
            handleSelect(e) {
                switch (e.target.value) {
                    case "":
                        break;
                    case "1":
                        this.$store.dispatch('sortFirstName');
                        this.$store.dispatch('sortAscending');
                        break;
                        
                    case "2":
                        this.$store.dispatch('sortLastName');
                        this.$store.dispatch('sortAscending');
                        break;
                    case "3":
                        this.$store.dispatch('sortFirstName');
                        this.$store.dispatch('sortDescending');
                        break;
                    case "4":
                        this.$store.dispatch('sortLastName');
                        this.$store.dispatch('sortDescending');
                        break;
                }
            }
        }
    }
</script>