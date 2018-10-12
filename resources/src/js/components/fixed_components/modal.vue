<template>
  <transition v-if="modalVisible" name="modal">
    <div class="modal-mask" >
      <div class="modal__wrapper">
        <div class="modal__container">
          <div class="modal-body">
            <slot name="body">
              <modals-carousel :student="modalData"></modals-carousel>
            </slot>
          </div>
          <div class="modal-footer cf">
            <div name="footer">
              <croppa-functionality v-if="croppaAvailable"></croppa-functionality>
            </div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
    import croppaFunctionality from "../profile_components/croppaFunctionality.vue";
    import modalsCarousel from "../profile_components/modalsCarousel.vue";
    import { mapGetters, mapMutations, mapActions } from 'vuex';
    export default {
        name: "modal",

        data: function() {
          return{
            croppaAvailable: true,
          }
        },

        computed: {
          ...mapGetters(["modalVisible", "modalData"])
        },

        mounted(){
            this.$root.$on('newSlide', () => {
                this.croppaToggle()
            })
        },

        watch: {
          
          modalVisible() {
            
            this.upDate();
          }
        },

        components: {
            croppaFunctionality,
            modalsCarousel
        },
        methods: {


           upDate() {
             if(this.modalVisible === true)
             {
               
               this.$store.dispatch("toggleCropping", true);
             } 
           },

          croppaToggle(){
            this.croppaAvailable = !this.croppaAvailable;
          }
        },
    }
</script>



