<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-header">
            <div class="fa fa-times-circle fa-3x pull-right modal_exit" @click="$emit('close')"></div>
            <slot class="type--center" name="header"></slot>
          </div>
          <div class="modal-body">
            <slot name="body">
              <!-- default body -->
            </slot>
          </div>
          <div class="modal-footer">
            <div name="footer"></div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "modal",

        data() {
            return  {
                showModal: false
            }
        },
    }
</script>



