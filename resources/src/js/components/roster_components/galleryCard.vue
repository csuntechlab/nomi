<template>
    <div v-if="showMe">
        <div>
            <div class="col-xs-6">
                <div class="panel grid-image card">
                    <div class="panel__content">
                        <profile-picture :image="image"></profile-picture>
                        <div class="card-title font-style">
                            <div class="panel-heading align-center">
                                <div class="type--center">
                                    <router-link class="textOverflow" :to="'/profile/'+this.$route.params.id+'/'+email_uri">
                                        <h4>{{display_name}}</h4>
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
            <modal v-if="showModal" @close="setImgUrl">
                <div slot="header"></div>
                <div slot="body">
                    <croppa-profile :studentName="display_name" :emailURI="email_uri" :studentImage="image"></croppa-profile>
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
                showModal: false,
                showMe: true
            }
        },
        components: {
            modal,
            croppaProfile
        },

        props: ['student'],

        computed: {
            display_name: function () {
                return this.student.first_name + " " + this.student.last_name[0] + ".";
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
            setImgUrl (url) {
                this.showModal = false;
                this.imgUrl = url;
            }
        }
    }
</script>
