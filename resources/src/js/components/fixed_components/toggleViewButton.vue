<template>
<!-- <<<<<<< HEAD
    <div v-if="cards">
            <i class="fa fa-list-ul fa-3x type--white" title="List"  @click="emitToggleView()"></i>
    </div>
    <div v-else>
            <i class="fa fa-th-large fa-3x type--white" title="Grid" @click="emitToggleView()"></i> 
======= -->
    <div>
        <i v-if="this.list" class="fa fa-list-ul fa-3x type--white" title="List" @click="$store.commit('toggleList')"></i>
        <i v-else class="fa fa-th-large fa-3x type--white" title="Grid" @click="$store.commit('toggleList')"></i>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "toggle-view-button",
        computed: {
            ...mapGetters([
                'list'
            ])
        }
    }
</script>
