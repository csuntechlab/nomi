<template>
    <div class="profile__img">
        <croppa
            v-model="croppa"
            :prevent-white-space="true"
            :show-remove-button="false"
            :auto-sizing="true"
            :quality="2"
            :disabled = disabled
            @init="styleCanvas()"
            >
            <!-- <img slot="initial" :src="studentProfile.student.images.likeness"/> -->
             <div class="croppa-loading__icon" v-if="croppa && croppa.loading">
                 <i class="fas fa-spinner fa-spin fa-5x"></i>
             </div>
            <img crossOrigin="anonymous" :src="studentProfile.student.images.likeness" slot="initial" >
        </croppa>
        
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
                croppa: null,
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

            confirmImage: function () {
                
                if (!this.croppa.hasImage()) {
                    alert('no image');
                } else {
                    // console.log(this.myCroppa.generateDataUrl('jpg', .8);
                    var url = this.croppa.generateDataUrl('image/jpg', .8);
                    console.log(url);
                    // let payload = {studentId: this.studentProfile.id, imgUrl: url};
                    let payload = {
                        id: this.facultyMember.id,
                        profile_image: url,
                        image_type: 'likeness',
                        entity_type: 'student',
                        uri: this.studentProfile.emailURI
                    };
                    console.log(payload);
                    // this.$store.dispatch('updateImage', payload);

                    // let emuri = this.studentProfile.email.substring(0, this.studentProfile.email.indexOf('@'));

                    window.axios.post('/api/upload', {
                        payload
                    }).then(response => {
                        if (response.status) {
                            this.disabled = true;
                            this.$store.dispatch('getOnlyData');
                            this.$parent.$emit('close', url);
                            console.log(response.status);
                        } else {
                            console.error('OH NO');
                        }
                    }).catch(e => {
                        url = null;
                        console.log(e);
                        this.disabled = true;
                        this.$parent.$emit('close', url);
                    });

                this.croppa.refresh()
                }
                // this.app.$forceUpdate()
                
            },

            styleCanvas: function() {
                let elm = this.croppa.getCanvas();

                elm.style.width="100%";
                elm.style.height="100%";
                elm.style.borderRadius="50%";
            },

            chooseImage: function() {
                this.disabled = false;
                console.log(this)
                this.croppa.chooseFile();
            }
        }
    }
</script>
