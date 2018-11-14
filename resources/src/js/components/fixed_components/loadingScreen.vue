<template>
    <div :class="[ this.doYouNomi ? 'post-login nomi-logo--bored type--center' : 'post-login type--center' ]">
        <div class="post-login-container" @click="getToNomi">
            <div>
                <div v-show="this.doYouNomi" class="fun-counter">
                    <h1>Animals Saved</h1>
                    <h2>🐺: {{ this.wolfCounter }}</h2>
                    <h2>🐻: {{ this.bearCounter }}</h2>
                    <h2>🐼: {{ this.pandaCounter }}</h2>
                    <h2>🐹: {{ this.hamsterCounter }}</h2>
                    <h2>🐶: {{ this.dogCounter }}</h2>
                </div>
            </div>
            <img class="nomi-logo nomi-logo--loading" src="/images/apple-touch-icon.png" alt="NOMI Logo; Names of Matador Individuals">
        </div>
    </div>
</template>

<script>

export default {
    name: 'loading-screen',

    data() {
        return {
            doYouNomi: false,
            doYouNomiCounter: 0,
            wolfCounter: 0,
            bearCounter: 0,
            pandaCounter: 0,
            hamsterCounter: 0,
            dogCounter: 0,
        };
    },

    methods: {
        getToNomi() {
            this.doYouNomiCounter += 1;
            if (this.doYouNomiCounter === 3) {
                this.doYouNomi = true;
            }

            if (this.doYouNomi) {
                let random = Math.floor((Math.random() * 5) + 1);
                if (random === 1) this.wolfCounter += 1;
                if (random === 2) this.bearCounter += 1;
                if (random === 3) this.pandaCounter += 1;
                if (random === 4) this.hamsterCounter += 1;
                if (random === 5) this.dogCounter += 1;
            }

            if (this.wolfCounter === 5 || this.bearCounter === 5 || this.pandaCounter === 5 || this.hamsterCounter === 5 || this.dogCounter === 5) {
                this.$store.dispatch('funTheme');
            }
        }
    },
};

</script>
