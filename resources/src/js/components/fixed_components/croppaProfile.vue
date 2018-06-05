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
            <div @click.prevent="confirmImage"><i class="fa fa-check fa-3x"></i></div>
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
                if (!this.myCroppa.hasImage()) {
                    alert('no image');
                } else {
                    let url = this.myCroppa.generateDataUrl('jpg', .8);
                    let payload = {studentId: this.studentProfile.id, imgUrl: url};
                    this.$store.dispatch('updateImage', payload);

                    let uri = null;
                    if (this.studentProfile.emailURI == null){
                        uri = this.emailURI;
                    } else {
                        uri = this.studentProfile.emailURI;
                    }

                    window.axios.post('/api/upload', {
                        id: this.facultyMember.id,
                        photo: url,
                        uri: uri
                    }).then(response => {
                        if (response.status) {
                            this.$store.dispatch('getData');
                            this.$parent.$emit('close', url);
                        } else {
                            console.error('OH NO');
                        }
                    }).catch(e => {
                        url = null;
                        console.log(e);
                        this.$parent.$emit('close', url);
                    });
                }
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
