<template>
  <div class="container center">
    <div>
      <h1>
        Tela usada apenas para exemplo de navegação. Clique na Logo para seguir
        o fluxo
      </h1>
    </div>
  </div>
</template> 

<script>
import axios from "axios";
import BaseHeader from "@/components/BaseHeader.vue";
export default {
  data() {
    return {
      user: {},
      slide: 0,
      sliding: true,
      time: "",
    };
  },
  components: {
    BaseHeader,
  },
  methods: {
    onSlideStart(slide) {
      this.sliding = true;
    },
    onSlideEnd(slide) {
      this.sliding = false;
    },
  },
  mounted() {
    this.user = JSON.parse(localStorage.getItem("user"));
    if (!localStorage.getItem("user")) {
      this.$router.push("/login");
    }
  },
};
</script>

<style scoped lang="scss">
h1 {
  font-family: "Montserrat";
  font-style: normal;
  font-weight: 600;
  font-size: 24px;
  line-height: 50px;
  text-align: center;
  width: 75%;
}
.float {
  animation: float 2s alternate infinite ease-in;
}
.center {
  display: grid;
  place-content: center;
}
</style>