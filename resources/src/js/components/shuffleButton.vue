<template>
    <div> <button @click="this.bus.$emit('shuffleCards')">Shuffle</button> </div>
</template>

<script>
    export default {
        name: "shuffle-button",
    }
</script>
