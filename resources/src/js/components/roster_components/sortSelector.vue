<template>
    <div v-if="!this.flash">
        <label for="name-sorting"></label>
        <div class="row">
            <div class="">
                <div class="col-xs-4 col-sm-4 settings_field" @click="$store.dispatch('sortFirstName')">FN</div>
                <div class="col-xs-4 col-sm-4 settings_field" @click="$store.dispatch('sortLastName')">LN</div>
            </div>
            <div class="">
                <i class="fas fa-2x fa-sort-alpha-up settings-button" @click="$store.dispatch('sortAscending')"></i>
            </div>
            <div class="">
                <i class="fas fa-2x fa-sort-alpha-down settings-button" @click="$store.dispatch('sortDescending')"></i>
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
            // handleSelect(e) {
            //     switch (e.target.value) {
            //         case "":
            //             break;
            //         case "1":
            //             this.$store.dispatch('sortFirstName');
            //             this.$store.dispatch('sortAscending');
            //             break;
                        
            //         case "2":
            //             this.$store.dispatch('sortLastName');
            //             this.$store.dispatch('sortAscending');
            //             break;
            //         case "3":
            //             this.$store.dispatch('sortFirstName');
            //             this.$store.dispatch('sortDescending');
            //             break;
            //         case "4":
            //             this.$store.dispatch('sortLastName');
            //             this.$store.dispatch('sortDescending');
            //             break;
            //     }
            // }
        }
    }
</script>