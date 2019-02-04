<template>
    <div>
        <croppa
            v-model="myCroppa"
            v-if="toggleCroppa"
            :prevent-white-space="true"
            :show-remove-button="false"
            :quality="2"
            placeholder="Waiting for upload..."
            @init="styleCanvas()"
            @loading-start="loadingStart"
            @loading-end="loadingEnd">
        </croppa>
        <div v-if="loadingCroppa" class="croppa-loading_icon">
            <i class="fas fa-spinner fa-spin fa-3x"></i>
        </div>
    </div>
</template>
<script>
    import { mapGetters, mapActions } from "vuex";
    import moment from 'moment';

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
                loadingCroppa: false,
            }
        },
        computed: {
            ...mapGetters([
                'studentProfile',
                'facultyMember',
                'toggleCroppa'
            ]),
        },

        mounted(){
            this.$root.$on('chooseImage', () => {
                this.chooseImage();
            }),
            this.$root.$on('confirmImage', () => {
                this.confirmImage();
            })
        },

        created: function () {
            this.url = document.querySelector('meta[name=app-url]').content;
            this.myCroppa = null;
            this.fileInput = null;
        },
        methods: {

            ...mapActions([
                'setTimestamp'
            ]),

            loadingStart(){
                this.loadingCroppa = true;
            },
            loadingEnd(){
                this.loadingCroppa = false;
            },
            confirmImage: function () {
                if (!this.myCroppa.hasImage()) {
                    alert('no image');
                } else {
                    let url = this.myCroppa.generateDataUrl('jpg', .8);
                    let emuri = this.student.email_uri;
                    let photoId = (this.$route.name === "class") ? 'photo-gallery--' + emuri : 'profile__img--border';
                    let photoElement = document.getElementsByClassName(photoId);
                    let photoSrc = photoElement[0].getAttribute('src');
                    
                    if (photoSrc.includes("likeness")) {
                        photoElement = photoElement[0];
                    } else {
                        photoElement = photoElement[1];
                        photoSrc = photoElement.getAttribute('src');
                    }
                    photoElement.setAttribute('src', './images/profile-loading.gif');

                    window.axios.post('/api/upload', {
                        id: this.facultyMember.id,
                        profile_image: url,
                        image_type: 'likeness',
                        entity_type: 'student',
                        uri: emuri,
                    }).then(response => {
                        if (response.status) {
                            this.$store.dispatch('startUploadFeedback');
                            this.$parent.$emit('close', url);
                            this.url = ""; 
                            photoElement.setAttribute('src', photoSrc + '&' + moment().format('DDhmmss'));
                        } else {
                            console.error('OH NO');
                        }
                    }).catch(e => {
                        url = null;
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

            //DO NOT TOUCH! Hacky fix for croppa fileinput 
            chooseImage: function() {
                if(this.myCroppa.$refs.fileInput) {
                    this.fileInput = this.myCroppa.$refs.fileInput;
                    this.myCroppa.chooseFile();
                    this.$root.$emit('letsSwitchItUp');
                } else {
                    this.myCroppa.$refs.fileInput = this.fileInput;
                    this.myCroppa.chooseFile();

                }
                
            }
        }
    }
</script>
