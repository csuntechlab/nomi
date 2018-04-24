<template>
    <div class="">
        <div class="grid-image">
            <label class="" :for="sp_display_name">
                <profile-picture v-if="disabled" :image="sp_images['likeness']"></profile-picture>
                <croppa v-else
                        v-model="myCroppa"
                        :prevent-white-space="false"
                        :show-remove-button="false"
                        :disabled="disabled"
                        :initial-image="sp_images['likeness']"
                        :quality="2"
                        @init="styleCanvas()">
                </croppa>
            </label>
            <div class="">
                <div v-if="show=true">
                    <button class="btn btn-default" @click="edit = true"><i class="fa fa-pencil-alt fa-3x"></i></button>
                </div>
                <div v-else></div>
                <div v-if="edit">
                    <button class="btn btn-default" @click="toggleCropper"><i class="fa fa-edit fa-3x"></i></button>
                    <button class="btn btn-default" @click="uploadFile"><i class="fa fa-camera fa-3x"></i></button>
                    <button class="btn btn-default" @click="confirmImage"><i class="fa fa-check fa-3x"></i></button>
                </div>
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
                disabled: true,
                edit: false,
                show:true,
            }
        },

        computed: {
            ...mapGetters([
                'sp_display_name',
                'sp_emailURI',
                'sp_images'
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
                data.append('media', url);
                data.append('email', this.sp_emailURI);

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
