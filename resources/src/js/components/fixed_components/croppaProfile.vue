<template>
    <div>
        <croppa v-model="myCroppa"
                :prevent-white-space="false"
                :show-remove-button="false"
                :disabled="true"
                :placeholder="this.student.image"
                :initial-image="this.student.image"
                :quality="2"
                @init="styleCanvas()">
        </croppa>
    </div>

</template>
<script>
    export default {

        data: function() {
            return{
                messages: true,
                errors: [],
                myCroppa: null,
                imgUrl: this.student.image,
            }

        },

        props:['student'],

        computed: {
            display_name: function () {
                return this.student.first_name + " " + this.student.last_name;
            },

            email_uri : function () {
                return this.student.email.split('@')[0];
            }
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