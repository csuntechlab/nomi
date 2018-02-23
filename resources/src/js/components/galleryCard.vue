<template>
    <div class="col-xs-6">
        <div class="panel">
            <div class="grid-item panel-content">
                <label :for="student.display_name">
                    <input class="hide" :id="student.display_name" @change="changePhoto($event, student.email)" type="file" name="photo" accept="image/*">
                    <croppa><img :id="student.display_name+'-img'" :src="student.image" class="img--circle grid-image" name="photo" accept="image/*"></croppa>
                </label>
                <div class="card-title">
                    <div class="panel-heading">
                        {{student.display_name}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "gallery-card",

    data: function () {
        return {
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
    }
}
</script>
