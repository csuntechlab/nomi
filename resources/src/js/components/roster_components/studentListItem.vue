<template>
    <router-link :to="'/profile/'+this.$route.params.id+'/'+email_uri" @click.native="getStudent()">
        <div class="roster-list__item">
        <div class="row">
            <div class="col-xs-3 col-md-2">
                <profile-picture class="pull-left" :name="display_name" :image="image" :type="'roster'"></profile-picture>
            </div>
            <div class="col-xs-9 col-md-10">
                <span>
                    <div class="student_list_first_name student_list_first_name_mobile">{{this.student.first_name}}</div>
                    <div class="student_list_last_name student_list_last_name_mobile">{{this.student.last_name}}</div>
                </span>
            </div>
        </div>
        </div>
    </router-link>
</template>

<script>
import { mapGetters } from 'vuex';
import { mapState } from 'vuex';
import modal from '../fixed_components/modal.vue';
import { getImage } from './../../mixins/getImage.js';
import { refetchImage } from './../../mixins/refetchImage.js';
import profilePicture from '../profile_components/profilePicture.vue';

export default {
    name: 'student-list-item',
    props: ['student'],
    mixins: [getImage, refetchImage],

    components: {
        modal,
        profilePicture,
    },

    computed: {
        ...mapGetters([
        ]),

        display_name() {
        return `${this.student.first_name} ${this.student.last_name}`;
        },

        email_uri() {
        return this.student.email.split('@')[0];
        },
    },

    methods: {
        getStudent() {
            this.$store.dispatch('getStudent', {studentID: this.student.student_id, email: this.student.email, first_name: this.student.first_name, last_name: this.student.last_name})
        },
	},
};
</script>
