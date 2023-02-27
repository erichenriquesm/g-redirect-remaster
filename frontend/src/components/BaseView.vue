<template>
  <div class="grid">
    <Menu />
    <slot> </slot>
  </div>
</template>

<script>
import Menu from "@/components/Menu/Menu.vue";
import MiddlewareService from "@/services/MiddlewareService.js";
export default {
  data() {
    return {};
  },
  components: {
    Menu,
  },
  methods: {
    revoke() {
      setInterval(() => {
        MiddlewareService.get("/revoke").then((resp) => {
          if (resp.data.token) {
            localStorage.setItem("user", JSON.stringify(resp.data));
          }
        });
      }, 300000);
    },
  },
  mounted() {
    this.revoke();
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
