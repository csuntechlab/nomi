<template>
    <div>
        <label for="list-grid"></label>
        <div class="row fullscreen_width">
            <div v-if="this.list">
                <!-- 0, selected  -->
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-settings__button" @click="$store.dispatch('setList')">
                        <i class="fas fa-list-ul"></i> List
                    </button>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-settings__button" @click="$store.dispatch('setGallery')">
                        <i class="fas fa-users"></i> Gallery
                    </button>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-settings__button" @click="$store.dispatch('setFlash')">
                        <i class="fas fa-clone"></i> Flashcards
                    </button>
                </div>
            </div>
            <div v-else-if="this.flash">
                <!-- 2 selected -->
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-settings__button" @click="$store.dispatch('setList')">
                        <i class="fas fa-list-ul"></i> List
                    </button>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-settings__button" @click="$store.dispatch('setGallery')">
                        <i class="fas fa-users"></i> Gallery
                    </button>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-settings__button" @click="$store.dispatch('setFlash')">
                        <i class="fas fa-clone"></i> Flashcards
                    </button>
                </div>
            </div>
            <div v-else>
                <!-- 1 selected  -->
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-settings__button" @click="$store.dispatch('setList')">
                        <i class="fas fa-list-ul"></i> List
                    </button>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-settings__button" @click="$store.dispatch('setGallery')">
                        <i class="fas fa-users"></i> Gallery
                    </button>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-sm roster-settings__button" @click="$store.dispatch('setFlash')">
                        <i class="fas fa-clone"></i> Flashcards
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
