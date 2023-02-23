<template>
  <button @click.prevent="click" :class="variant"><slot></slot></button>
</template>

<script>
export default {
  props: ["variant"],
  methods: {
    click() {
      this.$emit("click");
    },
  },
};
</script>

<style scoped lang="scss">
button {
  border: none;
  height: 45px;
  border-radius: 5px;
  padding: 10px 25px;
  transition: 0.3s;
  &:hover {
    transform: scale(1.2);
  }
}
.primary {
  background-color: rgb(12, 182, 12);
  color: white;
}
.info {
  background-color: rgb(34, 34, 247);
  color: white;
}
.info-light {
  background: rgba(33, 51, 210, 0.1);
  border-radius: 5px;
  color: #2133d2;
}
.outline-info {
  background: white !important;
  border: 0.5px solid #2133d2 !important;
  height: 32px !important;
  padding: 1px 16px !important;
  color: #2133d2;
}
.outline-info2 {
  background: white !important;
  border: 0.5px solid #2133d2 !important;
  color: #2133d2;
  &:hover{
    background: #2133d2;
    transform: scale(1);
  }
}
</style>