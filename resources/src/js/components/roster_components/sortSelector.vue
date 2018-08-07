<template>
    <div v-if="!this.flash">
        <label for="name-sorting"></label>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="col-xs-8 col-sm-8 col-md-8">
                <div class="col-xs-5 col-sm-5" @click="$store.dispatch('sortFirstName')">First Name</div>
                <div class="col-xs-5 col-sm-5" @click="$store.dispatch('sortLastName')">Last Name</div>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <i class="fas fa-sort-alpha-up" @click="$store.dispatch('sortAscending')"></i>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <i class="fas fa-sort-alpha-down" @click="$store.dispatch('sortDescending')"></i>
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