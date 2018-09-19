<template>
    <div v-if="!this.flash">
        <label for="name-sorting"></label>
        <div class="row type--center roster-sorting">
            <span v-if="!sortLastName" class="roster-sorting__name--selected roster--align" @click="$store.dispatch('sortFirstName')">First Name</span>
            <span v-else class="roster-sorting__name roster--align" @click="$store.dispatch('sortFirstName')">First Name</span>
            <span v-if="sortLastName" class="roster-sorting__name--selected" @click="$store.dispatch('sortLastName')">Last Name</span>
            <span v-else class="roster-sorting__name" @click="$store.dispatch('sortLastName')">Last Name</span>
            <span v-if="sortAscending == true" class="fas roster-sorting__sort" @click="sortDes">
                <svg enable-background="new 0 0 448 512" version="1.1" viewBox="0 0 448 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                    <path d="M187.298 395.314l-79.984 80.002c-6.248 6.247-16.383 6.245-22.627 0L4.705 395.314C-5.365 385.244 1.807 368 16.019 368H64V48c0-8.837 7.163-16 16-16h32c8.837 0 16 7.163 16 16v320h47.984c14.241 0 21.363 17.264 11.314 27.314zm119.075-180.007A12 12 0 0 1 294.838 224h-35.717c-8.22 0-14.007-8.078-11.362-15.861l57.096-168A12 12 0 0 1 316.217 32h39.566c5.139 0 9.708 3.273 11.362 8.139l57.096 168C426.886 215.922 421.1 224 412.879 224h-35.735a12 12 0 0 1-11.515-8.622l-8.301-28.299h-42.863l-8.092 28.228zm22.857-78.697h13.367l-6.6-22.937-6.767 22.937zm12.575 287.323l67.451-95.698a12 12 0 0 0 2.192-6.913V300c0-6.627-5.373-12-12-12H274.522c-6.627 0-12 5.373-12 12v28.93c0 6.627 5.373 12 12 12h56.469c-.739.991-1.497 2.036-2.27 3.133l-67.203 95.205a12.001 12.001 0 0 0-2.196 6.92V468c0 6.627 5.373 12 12 12h129.355c6.627 0 12-5.373 12-12v-28.93c0-6.627-5.373-12-12-12h-61.146c.74-.993 1.5-2.039 2.274-3.137z" fill="currentColor"/>
                </svg>
            </span>
            <span v-else class="fas roster-sorting__sort" @click="sortAsc">
                <svg enable-background="new 0 0 448 512" version="1.1" viewBox="0 0 448 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                    <path d="m187.3 395.3l-80 80c-6.2 6.2-16.4 6.2-22.6 0l-80-80c-10.1-10.1-2.9-27.3 11.3-27.3h48v-320c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v320h48c14.2 0 21.3 17.3 11.3 27.3zm141.9-14.3h13.4l-6.6-22.9-6.8 22.9zm12.6-213.1l67.5-95.7c1.4-2 2.2-4.4 2.2-6.9v-21.3c0-6.6-5.4-12-12-12h-125c-6.6 0-12 5.4-12 12v28.9c0 6.6 5.4 12 12 12h56.5c-0.7 1-1.5 2-2.3 3.1l-67.2 95.2c-1.4 2-2.2 4.4-2.2 6.9v21.9c0 6.6 5.4 12 12 12h129.4c6.6 0 12-5.4 12-12v-28.9c0-6.6-5.4-12-12-12h-61.1c0.7-1 1.4-2.1 2.2-3.2zm-35.5 300.4c-1.5 5.1-6.2 8.7-11.5 8.7h-35.8c-8.2 0-14-8.1-11.4-15.9l57.1-168c1.7-4.9 6.2-8.1 11.4-8.1h39.6c5.1 0 9.7 3.3 11.4 8.1l57.1 168c2.6 7.8-3.1 15.9-11.4 15.9h-35.7c-5.3 0-10-3.5-11.5-8.6l-8.3-28.3h-42.9l-8.1 28.2z"/>
                </svg>
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