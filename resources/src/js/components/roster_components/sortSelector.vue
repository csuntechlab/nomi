<template>
    <div v-if="this.flash && !this.list">
    </div>
    <div v-else>
        <label for="name-sorting"></label>
        <div v-if="this.sortLastName">
            <div v-if="this.sortDescending">
                <select name="name-sorting" id="name-sorting" @input="handleSelect">
                    <option value="1">First Name Ascending</option>
                    <option value="2">First Name Descending</option>
                    <option value="3">Last Name Ascending</option>
                    <option value="4" selected>Last Name Descending</option>
                </select>
            </div>
            <div v-else>
                <select name="name-sorting" id="name-sorting" @input="handleSelect">
                    <option value="1">First Name Ascending</option>
                    <option value="2">First Name Descending</option>
                    <option value="3" selected>Last Name Ascending</option>
                    <option value="4">Last Name Descending</option>
                </select>
            </div>
        </div>
        <div v-else>
            <div v-if="this.sortDescending">
                <select name="name-sorting" id="name-sorting" @input="handleSelect">
                    <option value="1">First Name Ascending</option>
                    <option value="2" selected>First Name Descending</option>
                    <option value="3">Last Name Ascending</option>
                    <option value="4">Last Name Descending</option>
                </select>
            </div>
            <div v-else>
                <select name="name-sorting" id="name-sorting" @input="handleSelect">
                    <option value="1" selected>First Name Ascending</option>
                    <option value="2">First Name Descending</option>
                    <option value="3">Last Name Ascending</option>
                    <option value="4">Last Name Descending</option>
                </select>
            </div>
        </div>
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
            handleSelect (e) {
                switch(e.target.value) {
                    case "":
                        break;
                    case "1":
                        this.$store.dispatch('sortFirstName');
                        this.$store.dispatch('sortAscending');
                        break;
                    case "2":
                        this.$store.dispatch('sortFirstName');
                        this.$store.dispatch('sortDescending');
                        break;
                    case "3":
                        this.$store.dispatch('sortLastName');
                        this.$store.dispatch('sortAscending');
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
