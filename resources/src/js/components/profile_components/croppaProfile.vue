<template>
    <div class="profile_padding img--circle img--fluid-custom">
        <croppa
            v-model="myCroppa"
            :prevent-white-space="true"
            :show-remove-button="false"
            :quality="2"
            @init="styleCanvas()"
            @loading-start="loadingStart"
            @loading-end="loadingEnd">
            <img crossOrigin="anonymous" :src="this.student.images.likeness" slot="initial" >
        </croppa>
        <div v-if="loadingCroppa" class="croppa-loading">
            <div class="croppa-loading_icon">
                <i class="fas fa-spinner fa-spin fa-5x"></i>
            </div>
        </div>
        
    </div>
</template>
<script>
    import { mapGetters } from "vuex";

    export default {
        name: "croppa-profile",

        props:['student'],

        data: function() {
            return{
                messages: true,
                errors: [],
                myCroppa: null,
                disabled: true,
                url: "",
                loadingCroppa: false
            }
        },

        mounted() {
            this.$root.$on('chooseImage', () => {
                this.chooseImage()
            }),
            this.$root.$on('confirmImage', () => {
                this.confirmImage()
            })
        },

        computed: {
            ...mapGetters([
                'studentProfile',
                'facultyMember'
            ]),

            
        },

        created: function () {
            this.url = document.querySelector('meta[name=app-url]').content;
         },

        methods: {
            loadingStart(){
                this.loadingCroppa = true;
            },

            loadingEnd(){
                this.loadingCroppa = false;
            },

            confirmImage: function (emailURI) {
                if (!this.myCroppa.hasImage()) {
                    alert('no image');
                } else {
                    let url = this.myCroppa.generateDataUrl('jpg', .8);
                    let payload = {studentId: this.studentProfile.id, imgUrl: url};
                    this.$store.dispatch('updateImage', payload);

                    let emuri = this.student.email.substring(0, this.student.email.indexOf('@'));

                    window.axios.post('/api/upload', {
                        id: this.facultyMember.id,
                        profile_image: url,
                        image_type: 'likeness',
                        entity_type: 'student',
                        uri: emuri
                    }).then(response => {
                        if (response.status) {
                            this.$store.dispatch('getOnlyData');
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
