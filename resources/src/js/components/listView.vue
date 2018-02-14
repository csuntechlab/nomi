<template>
    <div v-if="show">
        <h1>This is the List View Placeholder.</h1>
    </div>
</template>

<script>
    export default {
        created () {
            /** Creates listener for toggleView event, applying method on event. */
            this.$eventBus.$on('toggleView', function () {
                this.toggleViewHandler();
            }.bind(this));
        },

        name: "list-view",

        data: function () {
            return {
                show: false
            }
        },

        methods: {
            toggleViewHandler: function () {
                this.show = !this.show;
            }
        }
    }
</script>

<style scoped>

</style>