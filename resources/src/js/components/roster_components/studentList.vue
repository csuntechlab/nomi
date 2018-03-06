<template>
    <div v-if="show">
        <ul class="list">
            <student-list-item v-for="student in sortRoster(this.roster)" :key="student.last_name" :student="student"></student-list-item>
        </ul>
    </div>
</template>

<script>
    import studentListItem from './studentListItem.vue';
    export default {
        name: "student-list",

        created () {
            /** Creates listener for toggleView event, applying method on event. */
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

        components: {
            studentListItem
        },

        props: ['roster'],

        computed: {
            sortedRoster: () => {
                return this.roster;
                return this.roster.sort((a,b) => {
                    return a.last_name.localeCompare(b.last_name);
                });
            }
        },

        methods: {
            toggleViewHandler: function () {
                this.show = !this.show;
            },

            sortRoster: (roster) => {
                return roster.sort((a,b) => {
                    return a.last_name.localeCompare(b.last_name);
                });
            }
        }
    }
</script>
