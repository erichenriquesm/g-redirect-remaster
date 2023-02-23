<template>
  <div class="header">
    <h4>{{ title }}</h4>
  </div>
</template>

<script>
export default {
  props: ["title"],
};
</script>

<style scoped lang="scss">
.header {
  font-weight: 900;
  position: relative;
  &::after {
    content: "";
    height: 20px;
    width: 20px;
    background: #45BF86;
    position: absolute;
    left: -9px;
    top: 10px;
    border-radius: 5px;
    z-index: -1;
  }
}
</style>