<template>
    <div>
        <student-matrix :studentsjson="roster"></student-matrix>
        <student-list :studentsjson="roster"></student-list>
    </div>
</template>

<script>
    export default {
        name: "roster-container",

        props: [ 'roster' ],
    }
</script>
