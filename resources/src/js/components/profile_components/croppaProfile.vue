<template>
    <div>
        <croppa
            v-model="myCroppa"
            v-if="toggleCroppa"
            :prevent-white-space="true"
            :show-remove-button="false"
            :quality="2"
            placeholder="Waiting for upload..."
            @file-choose="handleImageCancelCase"
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

    export default {
        name: "croppa-profile",
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
                'term',
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
            handleImageCancelCase(){
                this.$root.$emit('letsSwitchItUp');
            },
            
            loadingStart(){
                this.loadingCroppa = true;
            },
            loadingEnd(){
                this.loadingCroppa = false;
            },
            confirmImage: function () {
                if (!this.myCroppa.hasImage()) {
                    this.$parent.$emit('close');
                } else {
                    let url = this.myCroppa.generateDataUrl('jpg', .8);
                    let emuri = this.studentProfile.emailURI;

                    let photoId = (this.$route.name === "class") ? 'photo-gallery--' + emuri : 'profile__img--border';
                    let photoElement = (this.$route.name === "class") ? document.getElementById(photoId) : document.getElementsByClassName(photoId);
                    let photoSrc = (this.$route.name === "class") ? photoElement.getAttribute('src') : photoElement[0].getAttribute('src');

                    if (this.$route.name === "profile") {
                        if (photoSrc.includes("likeness") || photoSrc.includes("base64")) {
                            photoElement = photoElement[0];
                        } else {
                            photoElement = photoElement[1];
                        }
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
                            this.$store.dispatch('updatedImage', {student_id: this.studentProfile.id, image: url});
                            this.$store.dispatch('imagePriority');
                            photoElement.setAttribute('src', url);
                            this.$store.dispatch(
                                'updateStudentPriority',
                                {
                                    student_id: this.studentProfile.id,
                                    image_priority: 'likeness',
                                }
                            );
                            this.$store.dispatch(
                                'updateImagePriority',
                                {
                                    student_id: this.studentProfile.id,
                                    image_priority: 'likeness',
                                    faculty_id: this.facultyMember.id.replace("members:", ""),
                                    term: this.term,
                                }
                            );
                            this.$parent.$emit('close', url);
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
                } else {
                    this.myCroppa.$refs.fileInput = this.fileInput;
                    this.myCroppa.chooseFile();

                }
                
            }
        }
    }
</script>
