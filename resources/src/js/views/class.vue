<template>
    <div>
        <course-banner></course-banner>
        <settings-banner></settings-banner>
        <div class="container">
            <roster-container :courseid="this.$route.params.id"></roster-container>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
    export default {
        name: "class",
        created () {
            this.$store.dispatch('clearErrors');
        },
    }
</script>
