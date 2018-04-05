<template>
    <div>
        <label for="name-sorting"></label>
        <select name="name-sorting" id="name-sorting" @input="handleSelect">
            <option value="">-- Select Sort --</option>
            <option value="1">First Name Descending</option>
            <option value="2">Last Name Descending</option>
            <option value="3">First Name Ascending</option>
            <option value="4">Last Name Ascending</option>
        </select>
    </div>
</template>

<script>
    export default {
        name: "sort-selector",

        methods: {
            handleSelect (e) {
                switch(e.target.value) {
                    case "":
                        break;
                    case "1":
                        this.$store.dispatch('sortFirstName');
                        this.$store.dispatch('sortDescending');
                        break;
                    case "2":
                        this.$store.dispatch('sortLastName');
                        this.$store.dispatch('sortDescending');
                        break;
                    case "3":
                        this.$store.dispatch('sortFirstName');
                        this.$store.dispatch('sortAscending');
                        break;
                    case "4":
                        this.$store.dispatch('sortLastName');
                        this.$store.dispatch('sortAscending');
                        break;
                }
            }
        }
    }
</script>
