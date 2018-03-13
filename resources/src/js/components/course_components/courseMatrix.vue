<template>
    <div v-if="show">
        <div class="col-xs-6" v-for="course in courses">
            <div class="panel">
                <div class="grid-item panel-content">
                    <div class="card-title">
                        <div class="panel-heading">
                            <router-link :to="'/class/'+course.id+'/'+course.title">{{ course.title }}</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "course-matrix",

    created () {
        /** Create event listeners */
        this.$eventBus.$on('toggleView', function () {
            this.toggleViewHandler();
        }.bind(this));

    },

    data: function () {
        return {
            show: true,
            messages: true,
            errors: [],
        }
    },

    props: ['courses'],

    methods: {
        toggleViewHandler: function () {
            this.show = !this.show;
        }
    },

}

</script>
