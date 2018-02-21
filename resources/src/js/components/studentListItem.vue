<template>
    <li class="list__item">{{student.display_name}}</li>
</template>

<script>
    export default {
        name: "student-list-item",
        props: ['student']
    }
</script>

