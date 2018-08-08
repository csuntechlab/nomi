<template>
    <div v-if="!this.flash">
        <label for="name-sorting"></label>
        <div class="row type--center roster-sorting">
            <span v-if="!sortLastName" class="roster-sorting__name--selected" @click="$store.dispatch('sortFirstName')">First Name</span>
            <span v-else class="roster-sorting__name" @click="$store.dispatch('sortFirstName')">First Name</span>
            <span v-if="sortLastName" class="roster-sorting__name--selected" @click="$store.dispatch('sortLastName')">Last Name</span>
            <span v-else class="roster-sorting__name" @click="$store.dispatch('sortLastName')">Last Name</span>
            <span v-if="sortAscending == true">
                <i class="fas roster-sorting__sort fa-sort-alpha-down" @click="sortDes"></i>
            </span>
            <span v-else>
                <i class="fas roster-sorting__sort fa-sort-alpha-up" @click="sortAsc"></i>
            </span>
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
                'sortAscending',
                'sortLastName'
            ])
        },

        methods: {
            sortAsc: function () {
                this.$store.dispatch('sortAscending');
            },
            sortDes: function () {
                this.$store.dispatch('sortDescending');
            }
        }

    }
</script>