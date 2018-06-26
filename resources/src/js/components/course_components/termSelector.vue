<template>
    <div>
        <label for="semester-select"></label>
            <div v-if="spring">
                <select name="semester-select" id="sem-select" @input="handleSelect">
                    <option value="0" selected>Spring</option>
                    <option value="1">Summer</option>
                    <option value="2">Fall</option>
                    <option value="3">Winter</option>
                </select>
            </div>
            <div v-else-if="summer">
                <select name="semester-select" id="sem-select" @input="handleSelect">
                    <option value="0">Spring</option>
                    <option value="1" selected>Summer</option>
                    <option value="2">Fall</option>
                    <option value="3">Winter</option>
                </select>
            </div>
            <div v-else-if="fall">
                <select name="semester-select" id="sem-select" @input="handleSelect">
                    <option value="0">Spring</option>
                    <option value="1">Summer</option>
                    <option value="2" selected>Fall</option>
                    <option value="3">Winter</option>
                </select>
            </div>
            <div v-else>
                <select name="semester-select" id="sem-select" @input="handleSelect">
                    <option value="0">Spring</option>
                    <option value="1">Summer</option>
                    <option value="2">Fall</option>
                    <option value="3" selected>Winter</option>
                </select>
            </div>

    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: "term-selector",

    computed: {
        ...mapGetters([

        ])
    },

    methods: {
        handleSelect (e) {
            switch(e.target.value) {
                case "0":
                    this.$store.dispatch('setSpring');
                    break;
                case "1":
                    this.$store.dispatch('setSummer');
                    break;
                case "2":
                    this.$store.dispatch('setFall');
                    break;
                case "3":
                    this.$store.dispatch('setWinter');
                    break
            }
        },
    }
}
</script>
