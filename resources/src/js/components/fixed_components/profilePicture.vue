<template>
    <div>
        <div class="img--circle">
            <img :id="display_name+'-img'" :src="this.student.image" class="img--circle grid-image" name="photo">
        </div>
    </div>

</template>
<script>
    export default {

        props:['student'],

    }

</script>