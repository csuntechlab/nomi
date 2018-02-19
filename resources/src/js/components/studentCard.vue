<template>
    <div class="col-xs-6">
        <div class="panel">
            <div class="grid-item panel-content">
                <label :for="student.display_name">
                    <input class="hide" :id="student.display_name" @change="changePhoto($event, student.email)" type="file" name="photo" accept="image/*">
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
    name: "student-card",

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
		changePhoto: function(event, email) {
//		    grabs id of image
            let imageId = document.getElementById(event.target.id + "-img");
//            checks if empty and sets file instance to variable files
            let files = event.target.files;
            if (!files[0]) {
                return;
            }

            let data = new FormData();
            data.append('media', files[0]);
            data.append('email', email);
            let reader = new FileReader();
//            On load of file, grab the image id's src that contains image
//				and equal it to the add image file
            reader.onload = (event) => {
                imageId.src = event.target.result;
            };

//            this check is needed to prevent "blob error"
            if(files[0]){
                reader.readAsDataURL(files[0]);
            }

            this.axios.post('http://nameface.test/api/upload', data, {
                headers: {
                	'Content-Type': 'multipart/form-data'
				}
			})
                .then(response => {
                    console.log(response);
				})
                .catch(e => {
                    this.errors.push(e)
                });
		},

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
