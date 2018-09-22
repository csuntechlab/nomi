<template>
  <transition v-if="showModal" name="modal">
    <div class="modal-mask">
      <div class="modal__wrapper">
        <div class="modal__container">
          <div class="modal-header clearfix">
            <div class="modal--adjust"><i class="fa fa-times-circle fa-2x pull-right modal--exit" @click="toggle()"></i></div>
            <slot name="header">
              
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
    export default {
        name: "modal",

        data: function() {
          return{
            showModal: false,
            croppaAvailable: true
          }
        },

        mounted(){
          this.$root.$on('showModal', () => {
                this.toggle()
            }),

            this.$root.$on('newSlide', () => {
                this.croppaToggle()
            })
        },

        components: {
            croppaFunctionality
        },
        methods: {
          toggle(){
            this.showModal = !this.showModal;
            this.croppaAvailable = true;
          },
          croppaToggle(){
            this.croppaAvailable = !this.croppaAvailable;
          }
        }
    }
</script>



