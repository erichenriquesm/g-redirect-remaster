<template>
  <div class="grid">
    <Menu />
    <slot> </slot>
  </div>
</template>

<script>
import Menu from "@/components/Menu/Menu.vue";
export default {
  data() {
    return {};
  },
  components: {
    Menu,
  },
};
</script>

<style scoped lang="scss">
.grid {
  display: grid;
  grid-template-columns: 210px 1fr;
  justify-content: center;
  position: relative;
}
</style>
