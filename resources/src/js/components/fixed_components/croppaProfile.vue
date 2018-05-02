<template>
    <div>
        <div>
            <label :for="studentProfile.displayName">
                <profile-picture v-if="disabled" :image="studentProfile.images['likeness']"></profile-picture>
                <croppa v-else
                        v-model="myCroppa"
                        :prevent-white-space="false"
                        :show-remove-button="false"
                        :disabled="disabled"
                        :initial-image="studentProfile.images['likeness']"
                        :quality="2"
                        @init="styleCanvas()">
                </croppa>
            </label>
            <div class="">
                <br>
                <button class="btn btn-default" @click="toggleCropper"><i class="fa fa-edit fa-4x"></i></button>
                <button class="btn btn-default" @click="uploadFile"><i class="fa fa-camera fa-4x"></i></button>
                <button class="btn btn-default" @click="confirmImage"><i class="fa fa-check fa-4x"></i></button>
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
                disabled: true
            }
        },

        computed: {
            ...mapGetters([
                'studentProfile',
                'facultyMember'
            ])
        },

        methods: {
            confirmImage: function () {
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
                data.append('id', this.facultyMember.id);
                data.append('media', url);
                data.append('email', this.studentProfile.emailURI);

                axios.post('api/upload', data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .catch(e => {
                        console.log(e)
                    });
            },

            styleCanvas: function() {
                let elm = this.myCroppa.getCanvas();

                elm.style.width="100%";
                elm.style.height="100%";
                elm.style.borderRadius="50%";
            },

            toggleCropper: function() {
                this.disabled = !this.disabled;
            },

            uploadFile: function() {
                this.myCroppa.chooseFile();
            }
        }
    }
</script>
