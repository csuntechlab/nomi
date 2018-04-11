<template>
    <div>
        <menu-up></menu-up>
        <menu-button></menu-button>
    </div>
</template>

<script>
    import menuUp from './menuUp'
    import menuButton from './menuButton'
    export default {
        components: {
            menuUp,
            menuButton
        }
    }
</script>