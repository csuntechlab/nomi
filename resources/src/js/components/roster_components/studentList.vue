<template>
    <div v-if="show">
        <ul class="list">
            <student-list-item v-for="student in this.roster" :key="student.last_name" :student="student"></student-list-item>
        </ul>
    </div>
</template>

<script>
    import studentListItem from './studentListItem.vue';
    export default {
        name: "student-list",

        created: function () {
            /** Creates listener for toggleView event, applying method on event. */
            this.$eventBus.$on('toggleView', function () {
                this.toggleViewHandler();
            }.bind(this));

            this.$eventBus.$on('sortRoster', function () {
                this.sortRosterHandler();
            }.bind(this));
        },

        data: function () {
            return {
                show: true,
                messages: true,
                errors: [],
                lastname: true,
            }
        },

        components: {
            studentListItem
        },

        props: ['roster'],

        methods: {
            toggleViewHandler: function () {
                this.show = !this.show;
            },

            sortRosterHandler: function () {
                function sortedRoster (self) {
                    if (self.lastname === true) {
                        return self.roster.sort((a, b) => {
                            return a.last_name.localeCompare(b.last_name);
                        });
                    } else {
                        return self.roster.sort((a, b) => {
                            return a.first_name.localeCompare(b.first_name);
                        });
                    }
                }

                this.lastname = !this.lastname;
                this.roster = sortedRoster(this);
            }
        }
    }
</script>
