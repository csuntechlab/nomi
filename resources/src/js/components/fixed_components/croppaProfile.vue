<template>
    <div>
        <div class="pull-right textOverflow">
            <h3>{{studentProfile.displayName}}</h3>
        </div>
        <croppa
                v-model="myCroppa"
                :prevent-white-space="false"
                :show-remove-button="false"
                :initial-image="studentImage"
                :quality="2"
                @init="styleCanvas()">
        </croppa>

        <div class="type--center">
            <div @click="chooseImage"><i class="fa fa-camera fa-3x"></i></div>
        </div>
        <div class="type--center">
            <div @click="confirmImage"><i class="fa fa-check fa-3x"></i></div>
        </div>
    </div>
</template>
<script>
    import { mapGetters } from "vuex";

    export default {
        name: "croppa-profile",

        props:['studentImage', 'emailURI'],

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
            confirmImage: function (emailURI) {
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

                if (this.studentProfile.emailURI == null){
                    data.append('uri', this.emailURI);
                } else {
                    data.append('uri', this.studentProfile.emailURI);
                }
                
                axios.post('api/upload', data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(() => {
                    this.$store.dispatch('getData')
                }).catch(e => {
                    console.log(e)
                });
                this.$parent.$emit('close')
                this.reset;

            },

            styleCanvas: function() {
                let elm = this.myCroppa.getCanvas();

                elm.style.width="100%";
                elm.style.height="100%";
                elm.style.borderRadius="50%";
            },
            chooseImage: function() {
                this.myCroppa.chooseFile();
                this.switch = false;
            }
        }
    }
</script>
