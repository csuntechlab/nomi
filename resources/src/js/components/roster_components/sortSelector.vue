<template>
    <div v-if="!this.flash">
        <label for="name-sorting"></label>
        <div class="row">
            <div class="">
                <div class="col-xs-4 col-sm-4 settings_field" @click="$store.dispatch('sortFirstName')">FN</div>
                <div class="col-xs-4 col-sm-4 settings_field" @click="$store.dispatch('sortLastName')">LN</div>
            </div>
            <div v-if="sortAscending == true">
                <i class="fas fa-2x fa-sort-alpha-down settings-button" @click="sortDes"></i>
            </div>
            <div v-else>
                <i class="fas fa-2x fa-sort-alpha-up settings-button" @click="sortAsc"></i>
            </div>
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