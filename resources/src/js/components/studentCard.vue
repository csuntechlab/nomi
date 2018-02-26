<template>
    <div v-if="flash">
        <flash-card :student="student"></flash-card>
    </div>
    <div v-else>
        <gallery-card :student="student"></gallery-card>
    </div>
</template>

<script>
import axios from 'axios';
import GalleryCard from "./galleryCard";
import FlashCard from "./flashCard";

export default {
    name: "student-card",

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

    props: [ 'student', 'flash' ],

}
</script>
