<template>
    <div class="col-xs-6">
        <div class="panel">
            <div class="grid-item panel-content">
                <label class="grid-image" :for="student.display_name">
                        <div style="width:100%">
                            <croppa v-model="myCroppa"
                                    :prevent-white-space="true"
                                    :show-remove-button="false"
                                    :disabled="true"
                                    :inital-image="imgUrl"
                                    @init="renderCanvas()"
                                    @loading-end="toggleCanEdit()">
                                <img slot="initial" 
                                    :src="imgUrl"
                                    @change="hello">
                            </croppa>
                        </div>
                </label>
                <div class="card-title">
                    <div class="panel-heading">
                        <button class="btn btn-default" @click="confirmImage">Confirm</button>
                        <br>
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

        confirmImage: function(){
            let url = this.myCroppa.generateDataUrl();

            if (!url) {
                alert('no image');
                return;
            }

            this.imgUrl = url;
            this.canEdit = false;
        },

        renderCanvas: function() {
            let elm = this.myCroppa.getCanvas();
            let cropper = this.myCroppa;

            elm.style.width="100%";
            elm.style.height="100%";
            elm.style.borderRadius="50%";

            elm.addEventListener('touchstart', (e) => {
                // Enable the cropper
                cropper.disabled = false;
            });

            elm.addEventListener('touchend', (e) => {
                if (!this.canEdit) {
                    cropper.chooseFile();
                    this.isCancelledPressed = true;
                } 
            })
        },

        toggleCanEdit: function() {
            if (this.firstLoad) {
                this.firstLoad = false;
            } else {
                let cropper = this.myCroppa;
                this.initalImage = this.myCroppa.generateDataUrl();
                this.isCancelledPressed = false;
                // console.log(this.initalImage == this.imgUrl);
                if (this.initalImage == this.imgUrl) {
                    this.canEdit = false;
                    cropper.disabled = true;
                } else {
                    this.canEdit = true;
                    cropper.disabled = false;
                }
            }
        },

        toggleCropper: function(){
            this.myCroppa.disabled(true);
        },

        hello: function() {
            console.log("hello");
        },

        updated() {
            console.log("This is happening.");
        }
    }
}
</script>
