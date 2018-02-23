<template>
    <div class="col-xs-6">
        <div class="panel">
            <div class="grid-item panel-content">
                <label :for="student.display_name">

                    <div v-if="enabled">

                        <croppa v-model="myCroppa" :prevent-white-space="true" :show-remove-button="false" class="grid-image img--circle">
                            <!--<input class="hide" :id="student.display_name" @change="changePhoto($event, student.email)" type="file" name="photo" accept="image/*">-->
                            <!--<img :id="student.display_name+'-img'" :src="student.image" class="grid-image" name="photo" accept="image/*">-->
                        </croppa>
                        <button class="btn btn-default" @click="confirmImage">I am here</button>


                    </div>
                    <div v-else>
                    <img @click="toggleCropper" class="img--circle" :src="imgUrl" >
                    </div>
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
            myCroppa: null,
            imgUrl: this.student.image,
            enabled: false
        }
    },

    props: [ 'student' ],

    methods: {
//        uploadCroppedImage() {
//            this.myImage.generateBlob((blob) => {
//                // write code to upload the cropped image file (a file is a blob)
//            }, 'image/jpeg', 0.8);
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

        confirmImage: function(){
            let url = this.myCroppa.generateDataUrl()
            if (!url) {
                alert('no image')
                return
            }
            this.imgUrl = url

            this.enabled = !this.enabled;

        },

        toggleCropper: function(){
            this.enabled = !this.enabled;
        }

    }
}
</script>
