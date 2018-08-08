<template>
    <div v-if="!this.flash">
        <label for="name-sorting"></label>
        <div class="row type--center">
            <span class="roster-settings__field" @click="$store.dispatch('sortFirstName')">First Name</span>
            <span class="roster-settings__field" @click="$store.dispatch('sortLastName')">Last Name</span>
            <span>
                <i class="fas fa-2x fa-sort-alpha-up" @click="$store.dispatch('sortAscending')"></i>
            </span>
            <span>
                <i class="fas fa-2x fa-sort-alpha-down" @click="$store.dispatch('sortDescending')"></i>
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