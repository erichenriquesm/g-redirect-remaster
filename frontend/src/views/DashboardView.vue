<template>
  <BaseView>
    <Dashboard />
  </BaseView>
</template>

<script>
import Dashboard from "@/components/Dashboard/Dashboard.vue";
import BaseView from "@/components/BaseView.vue";

export default {
  components: {
    Dashboard,
    BaseView,
  },
};
</script>

<style scoped lang="scss">
</style>