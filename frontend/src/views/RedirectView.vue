<template></template>

<script>
export default {
  mounted() {
    if (localStorage.getItem("user")) {
      this.$router.push("/dashboard");
      return;
    }
    this.$router.push('/login');
  },
};
</script>

<style>
</style>