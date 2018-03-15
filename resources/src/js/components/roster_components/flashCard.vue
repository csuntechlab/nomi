<template>
    <div class="col-xs-6">
        <div class="panel">
            <div class="grid-item panel-content" @click="updateRecognized(student.student_id)">
                <div v-if="known">
                    <div class="card-title back-of-card">
                        <div class="panel-heading" >
                            {{student.display_name}}
                        </div>
                    </div>
                </div>
                <div v-else>
                    <label :for="student.display_name">
                        <img :id="student.display_name+'-img'" :src="student.image" class="img--circle grid-image" name="photo" accept="image/*">
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "flash-card",

    data: function () {
        return {
            known: false,
            messages: true,
            errors: [],
        }
    },

    props: [ 'student' ],

    methods: {
		updateRecognized: function(id) {
            let data = new FormData();
            data.append('student_id', id);

            this.known = !this.known;

            this.$eventBus.$emit('updateRecognized', id, this.known);
        }
    }
}
</script>

<style scoped>
    .back-of-card {
        font-size: 300%;
        justify-content: center;
        align-items: center;
        display: flex;
    }
    .panel-heading {
        display: flex;
        justify-content: center;
        align-items: center;
        flex: 0 0 25%;
    }
</style>
