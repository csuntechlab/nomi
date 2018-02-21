<template>
    <div>
    <li class="list__item">{{student.display_name}}</li>
    </div>
</template>

<script>
    export default {
        name: "student-list-item",

        props:['student']
    }
</script>

<style>

</style>
