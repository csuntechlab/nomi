<template>
    <div>
        <div class="pull-right textOverflow">
            <h3>{{studentProfile.displayName || studentName}}</h3>
        </div>
        <croppa
                v-model="myCroppa"
                :prevent-white-space="true"
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

        props:['studentImage', 'emailURI', 'studentName'],

        data: function() {
            return{
                messages: true,
                errors: [],
                myCroppa: null,
                disabled: true,
                url: ""
            }
        },

        computed: {
            ...mapGetters([
                'studentProfile',
                'facultyMember'
            ])
        },

        created: function () {
         this.url = document.querySelector('meta[name=app-url]').content;
         },

        methods: {
            confirmImage: function (emailURI) {
                let url = this.myCroppa.generateDataUrl();

                if (!url) {
                    alert('no image');
                    return;
                }
                let id = this.studentProfile.id;
                let payload = {studentId: id, imgUrl: url};
                this.$store.dispatch('updateImage', payload);

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

                axios.post(this.url + 'api/upload', data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(() => {
                    this.$store.dispatch('getData');
                }).catch(e => {
                    url = null;
                    console.log(e);
                });

                this.$parent.$emit('close', url);
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
