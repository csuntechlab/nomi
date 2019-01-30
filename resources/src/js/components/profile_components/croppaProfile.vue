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
    import { mapGetters } from "vuex";
    import { mapActions } from "vuex";

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

                    var photoGalleryId = 'photo-gallery--' + this.student.email_uri;
                    var photoElement = document.getElementById(photoGalleryId);
                    // console.log("photoGalleryId is " + photoGalleryId);
                    var photoSource = photoElement.getAttribute('src');
                    // console.log(photoSource);
                    // photoElement.removeAttribute('src');
                    // photoElement.setAttribute('src','./images/profile-loading.gif')

                    


                    var copyOfPhotoElement = photoElement.cloneNode(true);
                    var photoElementParent = photoElement.parentNode

                    var loadingImage = copyOfPhotoElement.cloneNode(true);
                    loadingImage.setAttribute('src','./images/profile-loading.gif')
                    

                    photoElement.remove();

                    photoElementParent.appendChild(loadingImage);

                    window.axios.post('/api/upload', {
                        id: this.facultyMember.id,
                        profile_image: url,
                        image_type: 'likeness',
                        entity_type: 'student',
                        uri: emuri,
                    }).then(response => {
                        if (response.status) {
                            this.$store.dispatch('startUploadFeedback');
                            // this.$store.dispatch('setTimestamp', this.student.email_uri);
                            this.$parent.$emit('close', url);
                            this.url = "";

                            // photoElement.setAttribute('src',photoSource);
                            var attribute = copyOfPhotoElement.getAttribute('src');
                            loadingImage.remove();
                            copyOfPhotoElement.setAttribute('src',attribute + '?foo=bar')
                            photoElementParent.appendChild(copyOfPhotoElement);
                            


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
