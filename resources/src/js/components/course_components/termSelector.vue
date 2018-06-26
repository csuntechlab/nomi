<template>
    <div>
        <label for="semester-select"></label>
            <div v-if="this.semester == 9">
                <select name="semester-select" id="sem-select" @input="handleSelect">
                    <option value="0">Spring</option>
                    <option value="1">Summer</option>
                    <option value="2">Fall</option>
                    <option value="3" selected>Winter</option>
                </select>
            </div>
            <div v-else-if="this.semester == 5">
                <select name="semester-select" id="sem-select" @input="handleSelect">
                    <option value="0">Spring</option>
                    <option value="1" selected>Summer</option>
                    <option value="2">Fall</option>
                    <option value="3">Winter</option>
                </select>
            </div>
            <div v-else-if="this.semester == 7">
                <select name="semester-select" id="sem-select" @input="handleSelect">
                    <option value="0">Spring</option>
                    <option value="1">Summer</option>
                    <option value="2" selected>Fall</option>
                    <option value="3">Winter</option>
                </select>
            </div>
            <div v-else>
                <select name="semester-select" id="sem-select" @input="handleSelect">
                    <option value="0" selected>Spring</option>
                    <option value="1">Summer</option>
                    <option value="2">Fall</option>
                    <option value="3">Winter</option>
                </select>
            </div>
            <div>
                <input v-model.lazy="year" placeholder="Enter Term Year">
            </div>
            <button class="btn btn-default" @click="handleSubmit">Submit</button>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: "term-selector",

    data: function() {
        return{
            season: null,
            year: null,
        }
    },

    computed: {
        ...mapGetters([
            'semester',
        ])
    },

    methods: {
        handleSubmit () {
            switch(this.season) {
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
            this.$store.dispatch('setTermYear', this.year);
            this.$store.dispatch('updateTerm');
        },

        handleSelect (input) {
            this.season = input.target.value;
        },
    }
}
</script>
