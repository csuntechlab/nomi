<template>
    <div class="col-xs-6">
        <div class="panel">
            <div class="grid-item panel-content" @click="updateRecognized">
                <div v-if="known">
                    <div class="card-title back-of-card">
                        <div class="panel-heading" >
                            {{display_name}}
                        </div>
                    </div>
                </div>
                <div v-else>
                    <label :for="display_name">
                        <img :id="display_name+'-img'" :src="student.image" class="img--circle grid-image" name="photo" accept="image/*">
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

    computed: {
        display_name: function() { return this.student.first_name + " " + this.student.last_name; }
    },

    methods: {
		updateRecognized: function() {
            this.known = !this.known;
            this.$emit('markRecognized', {student_id: this.student.student_id, known: this.known});
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
