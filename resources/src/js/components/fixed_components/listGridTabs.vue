<template>
    <div class="tab-container">
        <ul class="tabs cf">
            <li :class="'col-xs-6 col-sm-6 col-md-6 '+this.gridBG" @click="gridHandler">
                <i
                    :class="'fa fa-th-large fa-3x '+this.gridFill"
                    title="Grid"
                > Grid</i>
            </li>
            <li :class="'col-xs-6 col-sm-6 col-md-6 '+this.listBG" @click="listHandler">
                <i
                    :class="'fa fa-list fa-3x '+this.listFill"
                    title="List"
                    @click="listHandler"
                > List</i>
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
