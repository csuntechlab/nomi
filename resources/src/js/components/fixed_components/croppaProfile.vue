<template>
    <div class="">
        <div class="grid-image">
            <label class="" :for="sp_display_name">
                <croppa v-model="myCroppa"
                        :prevent-white-space="false"
                        :show-remove-button="false"
                        :disabled="true"
                        :initial-image="imgUrl"
                        :quality="2"
                        @init="styleCanvas()">
                </croppa>
            </label>
            <div class="">
                    <br>
                    <button class="btn btn-default" @click="toggleCropper"><i class="fa fa-edit fa-4x"></i></button>
                    <button class="btn btn-default" @click="uploadFile"><i class="fa fa-camera fa-4x"></i></button>
                    <button class="btn btn-default" @click="confirmImage(imgEmail)"><i class="fa fa-check fa-4x"></i></button>
            </div>
        </div>
    </div>

</template>
<script>
    import { mapGetters } from "vuex";

    export default {
        name: "croppa-profile",

        data: function() {
            return{
                messages: true,
                errors: [],
                myCroppa: null,
                imgUrl: this.stdImg,
                imgEmail: this.stdEmail,
            }

        },

        props: ['stdImg', 'stdEmail'],

        computed: {

            ...mapGetters([
                'sp_display_name',
                'sp_emailURI'
            ])
        },

        methods: {
            confirmImage: function(email){
                let url = this.myCroppa.generateDataUrl();


                if (!url)
                {
                    alert('no image');
                    return;
                }

                this.imgUrl = url;

                this.myCroppa.generateBlob(
                    blob => {
                        var url = URL.createObjectURL(blob)
                        this.objectUrl=url
                    },
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