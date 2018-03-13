<template>
    <div v-if="sidebar==false">
        <button @click="emitToggleSideBar()">
            
        </button>
    </div>
</template>

<script>
    export default {
        name: "side-bar-button",

        data: function () {
            return {
                sidebar: false
            }
        },

        methods: {
            emitToggleSideBar: function () {
                this.$eventBus.$emit('ToggleSideBar');
                this.sidebar = !this.sidebar;
            }
        }
    }
</script>
