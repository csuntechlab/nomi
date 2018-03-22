<template>
    <div class="tab-container">
        <ul class="tabs cf">
            <li :class="'col-xs-6 col-sm-6 col-md-6 '+this.gridBG" @click="gridHandler">
                <div :class="'fa fa-th-large fa-3x '+this.gridFill" title="Grid">
                    <div class="tab-text">Grid</div>
                </div>
            </li>
            <li :class="'col-xs-6 col-sm-6 col-md-6 '+this.listBG" @click="listHandler">
                <div :class="'fa fa-list fa-3x '+this.listFill" title="List">
                    <div class="tab-text">List</div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: "list-grid-tabs",

    computed: {
        ...mapGetters([
            'list'
        ]),

        listBG: function () {
            if(this.list)
                return "blue-green";
            else
                return "navy-blue";
        },

        gridBG: function () {
            if(!this.list)
                return "blue-green";
            else
                return "navy-blue";
        },

        listFill: function () {
            if(this.list)
                return "on-fill";
            else
                return "off-fill";
        },

        gridFill: function () {
            if(!this.list)
                return "on-fill";
            else
                return "off-fill";
        },
    },

    methods: {
        listHandler: function () {
            if(!this.list) {
                this.$store.dispatch('toggleList');
            }
        },

        gridHandler: function () {
            if(this.list) {
                this.$store.dispatch('toggleList');
            }
        }
    }
}
</script>

<style scoped>
    li {
        text-align: center;
    }

    .tab-text{
        font-family: "museo-sans", "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
        float: right;
        margin: 0 1vw;
    }

    .on-fill {
        color: #F4F4F4;
    }

    .off-fill{
        color: #F4F4F4;
        transition: 25ms;
    }

    .off-fill:active {
        color: #4F9DA3;
        transform: scale(1.2);
    }
</style>
