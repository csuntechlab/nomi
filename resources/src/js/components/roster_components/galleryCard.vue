<template>
    <div class="col-xs-6">
        <div class="panel">
            <div class="grid-item bg--light-grey panel-content">
                <label class="grid-image" :for="display_name">
                    <croppa v-model="myCroppa"
                            :prevent-white-space="false"
                            :show-remove-button="false"
                            :disabled="true"
                            :initial-image="image"
                            :quality="2"
                            @init="styleCanvas()">
                    </croppa>
                </label>
                <div class="card-title-font-style">
                    <div class="panel-heading align-center">
                        <div class="font-style"><router-link :to="'/profile/'+email_uri">
                            {{display_name}}</router-link>
                        </div>
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
            imgUrl: null,
        }
    },

    props: ['student'],

    computed: {
        display_name: function () {
            return this.student.first_name + " " + this.student.last_name;
        },

        email_uri : function () {
            return this.student.email.split('@')[0];
        },

        image: function() {
            if (this.imgUrl == null) {
                return this.student.images[this.student.image_priority[0]];
            } else {
                return this.imgUrl;
            }
        }
    },

    methods: {
        confirmImage: function(email){
            let url = this.myCroppa.generateDataUrl();

            if (!url) {
                alert('no image');
                return;
            }

            this.imgUrl = url;

            this.myCroppa.generateBlob(
                blob => { this.objectUrl = URL.createObjectURL(blob); },
                'image/jpeg',
                .8
            );

            let data = new FormData();
            data.append('media', url);
            data.append('email', email);
            console.log(url);
            axios.post('api/upload', data, {
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
            this.myCroppa.disabled = false;
        },

        uploadFile: function() {
            this.myCroppa.chooseFile();
        }
    }
}
</script>
