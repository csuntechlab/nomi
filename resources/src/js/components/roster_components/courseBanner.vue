<template>
    <nav>
        <div class="tab-container">
            <ul class="tabs cf">
                <li v-for="course in this.courses" :key="course.title" :course="course"  class="tab__list">
                    <router-link class="courseTabs tab__link tab__link--active" :to="'/class/'+course.id">
                        COMP 182<!-- {{course.title}} -->
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
    import { mapGetters } from "vuex"
    export default {
        name: "course-banner",
        computed: {
            ...mapGetters([
                'courses'
            ]),
        },
    }
</script>