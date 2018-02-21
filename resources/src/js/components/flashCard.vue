<template>
    <div class="col-xs-6">
        <div class="panel">
            <div class="grid-item panel-content">
                <label :for="student.display_name">
                    <img :id="student.display_name+'-img'" :src="student.image" class="img--circle grid-image" name="photo" accept="image/*">
                </label>
                <div class="card-title">
                    <div class="panel-heading">
                        {{student.display_name}}
                    </div>
                </div>
                <div v-if="known">
                    <button role="button" class="btn btn-default" @click="updateRecognized(student.student_id)">Mark as unrecognized</button>
                </div>
                <div v-else>
                    <button role="button" class="btn btn-default" @click="updateRecognized(student.student_id)">Mark as recognized</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "flash-card",

    mounted () {
        /** Transform prop into attribute */
        this.known = this.student.recognized;
    },

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

            if(this.known) {
                this.axios.post('http://nameface.test/markAsUnrecognized', data)
                    .then(response => {
                        console.log(response);
                    })
                    .catch(e => {
                        this.errors.push(e)
                    });
            } else {
                this.axios.post('http://nameface.test/markAsRecognized', data)
                    .then(response => {
                        console.log(response);
                    })
                    .catch(e => {
                        this.errors.push(e)
                    });
            }

            this.known = !this.known;
        }
    }
}
</script>
