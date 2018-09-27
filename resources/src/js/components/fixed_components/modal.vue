<template>
  <transition v-if="modalVisible" name="modal">
    <div class="modal-mask" >
      <div class="modal__wrapper">
        <div class="modal__container">
          <div class="modal-header clearfix">
            <div class="modal--adjust"><i class="fa fa-times-circle fa-2x pull-right modal--exit" @click="showModal"></i></div>
            <slot name="header">
              <carousel-modal :student="modalData"></carousel-modal>
            </slot>
          </div>
          <div class="modal-body">
            <slot name="body">
              <!-- default body -->
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
    import carouselModal from "../profile_components/carouselModal.vue";
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

        components: {
            croppaFunctionality,
            carouselModal
        },
        methods: {
           ...mapMutations(['TOGGLE_MODAL']),
           ...mapActions(['toggleModal']),

           showModal() {
             this.toggleModal(!this.modalVisible)
           },

          croppaToggle(){
            this.croppaAvailable = !this.croppaAvailable;
          }
        },
    }
</script>



