<template>
    <div class="col-xs-6">
        <div class="panel">
            <div class="grid-item panel-content">
                <label class="grid-image" :for="student.display_name">

                            <croppa v-model="myCroppa"
                                    :prevent-white-space="false"
                                    :show-remove-button="false"
                                    :disabled="true"
                                    :quality="2"
                                    @init="styleCanvas()"
                                    >
                                <img slot="initial"
                                    :src="imgUrl">
                            </croppa>
                </label>

                <div class="card-title">
                    <div class="panel-heading align-center">
                        {{student.display_name}}
                        <br>
                        <button class="btn btn-default" @click="toggleCropper"><i class="fa fa-edit fa-4x"></i></button>
                        <button class="btn btn-default" @click="uploadFile"><i class="fa fa-camera fa-4x"></i></button>
                        <button class="btn btn-default" @click="confirmImage(student.email)"><i class="fa fa-check fa-4x"></i></button>
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
            enabled: true,
            canEdit: false,
            initalImage: null,
            firstLoad: true,
            isCancelledPressed: false
        }
    },

    props: ['student'],

    methods: {
		changePhoto: function(event, email) {
		    //grabs id of image
            let imageId = document.getElementById(event.target.id + "-img");
            //checks if empty and sets file instance to variable files
            let files = event.target.files;
            if (!files[0]) {
                return;
            }

            let data = new FormData();
            data.append('media', files[0]);
            data.append('email', email);
            let reader = new FileReader();
            //On load of file, grab the image id's src that contains image
            //and equal it to the add image file
            reader.onload = (event) => {
                imageId.src = event.target.result;
            };

            //this check is needed to prevent "blob error"
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

        confirmImage: function(email){
            let url = this.myCroppa.generateDataUrl();
            let newFile = this.myCroppa.getChosenFile();


            if (!url)
            {
                alert('no image');
                return;
            }

            this.imgUrl = url;

            let data = new FormData();
            data.append('media', newFile);
            data.append('email', email);
            console.log(email);
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

        styleCanvas: function() {
            let elm = this.myCroppa.getCanvas();

            elm.style.width="100%";
            elm.style.height="100%";
            elm.style.borderRadius="50%";
        },

        toggleCropper: function() {

            let cropper = this.myCroppa;

            cropper.disabled = false;
        },

        uploadFile: function() {
            let cropper = this.myCroppa;
            cropper.chooseFile();
        }
    }
}
</script>
