<template>
    <div class="col-xs-6">
        <div class="panel">
            <div class="grid-item panel-content">
                <div v-if="enabled">
                    <div class="mask">
                        <croppa v-model="myCroppa"
                                :width="200"
                                :height="200"
                                :quality="1"
                                :prevent-white-space="true"
                                :show-remove-button="false">
                        </croppa>
                    </div>
                    <button class="btn btn-default" @click="confirmImage">Confirm</button>
                </div>
                <div v-else>
                    <img @click="toggleCropper" :src="imgUrl" class="grid-image img--circle">
                </div>
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

            this.enabled = !this.enabled;
        },

        toggleCropper: function(){
            this.enabled = !this.enabled;
        }

    }
}
</script>
