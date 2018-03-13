<template>
    <div>
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
import { mapGetters } from 'vuex'
export default {
    name: "course-matrix",

    data: function () {
        return {
            show: false,
            messages: true,
            errors: [],
        }
    },

    computed: {
        ...mapGetters([
            'courses'
        ])
    },
}
</script>
