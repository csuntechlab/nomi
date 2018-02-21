<template>
    <div v-if="true">
        <gallery-card :student="student"></gallery-card>
    </div>
    <div v-else>
        <flash-card :student="student"></flash-card>
    </div>
</template>

<script>
import axios from 'axios';
import GalleryCard from "./galleryCard";
import FlashCard from "./flashCard";

export default {
    name: "student-card",

    mounted () {
        /** Transform prop into attribute */
    },

    data: function () {
        return {
            messages: true,
            errors: [],
        }
    },

    components: {
        FlashCard,
        GalleryCard
    },

    props: [ 'student' ],

    methods: {
    }
}
</script>
