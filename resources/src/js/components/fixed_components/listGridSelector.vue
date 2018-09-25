<template>
    <div>
        <label for="list-grid"></label>
        <div class="row fullscreen-width roster-sorting">
            <div v-if="this.list" class="roster-sorting-container">
                <!-- 0, selected  -->
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-sorting__button--selected" @click="$store.dispatch('setList')">
                        <i class="fas fa-list-ul"></i> List
                    </button>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-sorting__button" @click="$store.dispatch('setGallery')">
                        <i class="fas fa-users"></i> Gallery
                    </button>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-sorting__button" @click="$store.dispatch('setFlash')">
                        <i class="fas fa-clone"></i> Cards
                    </button>
                </div>
            </div>
            <div v-else-if="this.flash" class="roster-sorting-container">
                <!-- 2 selected -->
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-sorting__button" @click="$store.dispatch('setList')">
                        <i class="fas fa-list-ul"></i> List
                    </button>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-sorting__button" @click="$store.dispatch('setGallery')">
                        <i class="fas fa-users"></i> Gallery
                    </button>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-sorting__button--selected" @click="$store.dispatch('setFlash')">
                        <i class="fas fa-clone"></i> Cards
                    </button>
                </div>
            </div>
            <div v-else class="roster-sorting-container">
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-sorting__button" @click="$store.dispatch('setList')">
                        <i class="fas fa-list-ul"></i> List
                    </button>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-sorting__button--selected" @click="$store.dispatch('setGallery')">
                        <i class="fas fa-users"></i> Gallery
                    </button>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-sorting__button" @click="$store.dispatch('setFlash')">
                        <i class="fas fa-clone"></i> Cards
                    </button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: "list-grid-selector",

    computed: {
        ...mapGetters([
            'list',
            'flash'
        ])
    },
}
</script>
