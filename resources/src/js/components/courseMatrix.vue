<template>
    <div v-if="show">
        <!--for loop through array objects-->
        <div class="col-xs-6" v-for="course in this.courses">
            <div class="panel">
                <div class="grid-item panel-content">
                    <div class="card-title">
                        <div class="panel-heading">
                            {{course.title}}
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

    mounted () {
        /** Transform prop into attribute */
        this.courses = JSON.parse(this.coursesjson);
    },

    data: function () {
        return {
            courses: [],
            show: true,
            messages: true,
            errors: [],
        }
    },

    props: ['coursesjson'],

    methods: {
        toggleViewHandler: function () {
            this.show = !this.show;
        }
    },

}

</script>
