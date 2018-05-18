<template>
    <div>
        <div>
            <div class="col-xs-6">
                <div class="panel grid-image galleryCard">
                    <div class="panel__content ">
                        <profile-picture :image="image"></profile-picture>
                        <div class="card-title font-style">
                            <div class="panel-heading align-center">
                                <div class="type--center">
                                    <router-link class=" textOverflow" :to="'/profile/'+this.$route.params.id+'/'+email_uri">
                                        {{display_name}}
                                    </router-link>
                                </div>
                            </div>
                            <div class="type--center editButton">
                                <button @click="showModal = true">
                                <i class="fa fa-edit fa-2x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <modal v-if="showModal" @close="showModal = false">
                <div slot="header"></div>
                <div slot="body">
                    <croppa-profile :emailURI="email_uri" :studentImage="image"></croppa-profile>
                </div>
            </modal>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import { mapState } from 'vuex'
    import croppaProfile from "../../components/fixed_components/croppaProfile.vue";
    import modal from "../../components/fixed_components/modal.vue";

    export default {
        name: "gallery-card",

        data: function () {
            return {
                messages: true,
                errors: [],
                myCroppa: null,
                imgUrl: null,
                showModal: false
            }
        },
        components: {
            modal,
            croppaProfile
        },

        props: ['student'],

        computed: {
            display_name: function () {
                return this.student.first_name + " " + this.student.last_name;
            },

            email_uri : function () {
                return this.student.email.split('@')[0].replace("nr_", "");;
            },

            image: function() {
                if (this.imgUrl == null) {
                    return this.student.images[this.student.image_priority];
                } else {
                    return this.imgUrl;
                }
            }
        },

        methods: {
            confirmImage: function(email){
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
                data.append('email', email);
                console.log(url);
                axios.post('api/upload', data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(response => {
                        console.log(response);
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
                this.myCroppa.disabled = false;
            },

            chooseImage: function() {
                this.myCroppa.chooseFile();
            }
        }
    }
</script>
