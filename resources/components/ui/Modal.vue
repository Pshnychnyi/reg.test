<template>

  <transition name="slide-fade">
    <div class="modal__wrapper" @click="$emit('close')">

        <div class="modal-content" @click.stop>
          <div class="modal-header">
            <span class="modal-title">{{title}}</span>
            <span class="button-close" @click="$emit('close')">×</span>
          </div>
          <div class="modal-body">
            <slot name="body">default body</slot>
          </div>
        </div>
    </div>
  </transition>

</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true
    }
  }
}
</script>

<style lang="scss">
// Animation

.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from .modal-content,
.slide-fade-leave-to .modal-content {
  transform: translateX(500px);
  opacity: 0;
}

.modal__wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  transition: opacity .2s ease;
  right: 0;
  z-index: 998;
  background-color: rgba(00, 00, 00, .48);
}

.modal-content {
  position: relative;
  max-height: 100%;
  max-width: 600px;
  padding: 20px 18px 0 18px;
  background-color: #fff;
  border: 1px solid #dcdfe6;
  transition: all .2s ease;
  border-radius: 8px;
  overflow-y: scroll;
  z-index: 999;

  @media screen and (min-width: 900px) {
    min-width: 500px;
  }
}

.modal-header {
  display: flex;
  align-self: center;
  justify-content: space-between;
  padding-bottom: 20px;

  span {
    font-size: 24px;
  }

  .button-close {
    cursor: pointer;
  }
}

.modal-body {
  text-align: center;
}


</style>
