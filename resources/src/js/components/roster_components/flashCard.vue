<template>
    <div class="col-xs-6">
        <div class="panel">
            <div class="grid-item panel-content" @click="updateRecognized">
                <div v-if="known">
                    <div class="card-title">
                        <div class="panel-heading">
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
		updateRecognized: function() {
            this.known = !this.known;
            this.$emit('markRecognized', {student_id: this.student.student_id, known: this.known});
        }
    }
}
</script>
