<template>
    <div v-if="!this.flash">
        <label for="name-sorting"></label>
        <div class="row type--center">
            <span class="roster-settings__field" @click="$store.dispatch('sortFirstName')">First Name</span>
            <span class="roster-settings__field" @click="$store.dispatch('sortLastName')">Last Name</span>
            <span v-if="sortAscending == true">
                <i class="fas fa-sort-alpha-down" @click="sortDes"></i>
            </span>
            <span v-else>
                <i class="fas fa-sort-alpha-up" @click="sortAsc"></i>
            </span>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "sort-selector",

        data: function () {
            return {
                sortFirstName: true,
                sortAscending: true,
            }
        },

        computed: {
            ...mapGetters([
                'flash',
                'list',
                'sortAscending',
                'sortFirstName'
            ])
        },

        methods: {
            sortAsc: function(){
                this.sortAscending = true;
                this.$store.dispatch('sortAscending');
            },
            sortDes: function(){
                this.sortAscending = false;
                this.$store.dispatch('sortDescending');
            }
        }

    }
</script>