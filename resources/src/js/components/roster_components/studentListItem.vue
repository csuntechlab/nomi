<template>
    <router-link :to="'/profile/'+this.$route.params.id+'/'+this.student.email_uri" @click.native="setStudent()" data-interactable>
        <div class="roster-list__item">
        <div class="row">
            <div class="col-xs-3 col-md-2">
                <profile-picture class="pull-left" :name="this.student.display_name" :image="this.student.images[this.student.image_priority]" :type="'roster'"></profile-picture>
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
import { setStudent } from './../../mixins/setStudent.js';
import profilePicture from '../profile_components/profilePicture.vue';

export default {
    name: 'student-list-item',
    props: ['student'],
    mixins: [setStudent],
    components: {
        profilePicture,
    },
};
</script>
