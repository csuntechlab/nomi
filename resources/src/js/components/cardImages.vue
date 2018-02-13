<template>
    <div  class="grid-container">
        <!--for loop through array objects-->
		<div class="panel" v-for="student in JSON.parse(students)">
			<div class="grid-item panel-content">
				<div class="panel-heading">{{student.display_name}}</div>
					<!--Needs to be made into a separate component-->
					<label :for="student.display_name">
							<!--on upload call "changePhoto" method, ":id" is shorthand for v-bind, reference documentation-->
								<input class="hide" :id="student.display_name" @change="changePhoto($event, student.email);" type="file" name="photo" accept="image/*">
						<div class="crop">
								<img :id="student.display_name+'-img'" :src="student.image" class="img--circle crop img" name="photo" accept="image/*">
						</div>
                        <div v-if="student.recognized">
                            <button v-on:click="updateRecognized(student.recognized, student.student_id);">Mark as unrecognized</button>
                        </div>
                        <div v-else>
                            <button v-on:click="updateRecognized(student.recognized, student.student_id);">Mark as recognized</button>
                        </div>
					</label>
			</div>
		</div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    /*created () {
            console.log(JSON.parse(this.students))
	},*/
    data: function () {
        return {
            errors: [],
            messages: true
        }
    },

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


		updateRecognized: function(recognized, id) {

            let data = new FormData();
            data.append('student_id', id);

            if(recognized) {
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
        }
    },

    props: ['students']
}

</script>
