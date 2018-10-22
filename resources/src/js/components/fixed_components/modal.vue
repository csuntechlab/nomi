<template>
  <transition v-if="modalVisible" name="modal">
    <div class="modal-mask" >
      <div class="modal__wrapper">
        <div class="modal__container">
          <div class="type--center modal-header">
             <div class="pull-right modal--exit">
                <i class="fa fa-times-circle fa-2x" @click="showModal()"></i>
            </div>
            <div>
              <strong>{{modalData.first_name + " " + modalData.last_name}}</strong>
            </div>
           
          </div>
          <div class="modal-body">
            <div name="body">
              <modals-carousel :student="modalData"></modals-carousel>
            </div>
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
      name: 'modal',

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
          showModal() {

             this.$store.dispatch("toggleModal", false);
             this.$store.dispatch("toggleCropping", false);
             this.croppaAvailable = true;
           },



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



