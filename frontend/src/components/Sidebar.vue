<template>
  <div style="margin: 0">
    <b-sidebar
      id="sidebar-link"
      title="Criação de link"
      right
      no-header
      backdrop
      shadow
    >
      <div>
        <div class="header">
          <h1>Criação de link</h1>
          <p class="x" v-b-toggle.sidebar-link>x</p>
        </div>
        <div class="body">
          <div class="mb-3">
            <label class="title">Título do link</label>
            <input
              type="text"
              name="link"
              id="link"
              v-model="nome_link"
              placeholder="Nome do link"
            />
          </div>
          <div class="mb-3">
            <h1 class="blue-text">URL original</h1>
            <p>
              Você poderá inserir uma ou várias URL’s, faça como desejar.
              Lembre-se de inserir a quantidade de cliques junto à URL.
            </p>
          </div>
          <div>
            <div
              class="child-body"
              v-for="(item, index) in childs"
              :key="index"
            >
              <span class="ml-1">{{ index + 1 < 10 ? `0${index + 1}` : index + 1 }}</span>
              <div class="double-inputs">
                <input
                  placeholder="link"
                  type="text"
                  name="link"
                  id="link"
                  v-model="item.link"
                />
                <input
                  type="number"
                  name="link"
                  id="link"
                  :ref="`link-` + index"
                  @input="validaClick(`link-` + index, index)"
                  v-model="item.max_clicks"
                />
              </div>
            </div>
            <BaseButton
              @click="addOpt"
              class="child-button mb-3"
              variant="outline-info2"
            >
              <img class="opt" src="@/assets/icons/x.svg" alt="opt" />
              Adicionar mais URL</BaseButton
            >
          </div>
          <div class="mb-3">
            <h1 class="blue-text">URL default</h1>
            <p>
              Essa URL será associada ao redirecionamento apenas quando todas as
              outras chegarem ao limite de cliques. Ela será a uma url fixa sem
              limitação.
            </p>
            <input
              placeholder="Insira uma URL default"
              type="text"
              name="link"
              id="link"
              v-model="link"
            />
          </div>
        </div>
        <div class="btn-right">
          <BaseButton
            @click="addOpt"
            class="child-button mb-3"
            variant="info"
          >
            Salvar Link 💪</BaseButton
          >
        </div>
      </div>
    </b-sidebar>
  </div>
</template>

<script>
import BaseButton from "@/components/BaseButton.vue";
import Vue from "vue";
export default {
  data() {
    return {
      nome_link: "",
      link: "",
      childs: [{ link: "", max_clicks: 1 }],
    };
  },
  components: {
    BaseButton,
  },
  methods: {
    addOpt() {
      this.childs.push({ link: "", max_clicks: 1 });
    },
    validaClick(ref, index) {
      let max_clicks = this.$refs[ref][0].value;
      console.log();
      if (max_clicks <= 0) {
        Vue.set(this.childs[index], "max_clicks", 1);
      }
    },
  },
};
</script>

<style scoped lang="scss">
* {
  font-family: Montserrat;
}
.header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: black;
  color: white;
  h1 {
    font-size: 16px;
  }
  padding: 0px 10px;
  .x {
    color: white;
    font-size: 24px;
    cursor: pointer;
  }
}
label {
  font-size: 16px;
  font-weight: 600;
  line-height: 16px;
  letter-spacing: 0.20000000298023224px;
  text-align: left;
  margin-bottom: 10px;
}
.body {
  padding: 10px;
}
input {
  width: 100%;
  border: none;
  border-bottom: 1px solid #ededf0;
  outline: none;
  background: transparent;
  &::placeholder {
    font-size: 14px;
  }
}
p {
  font-family: "Montserrat";
  font-style: normal;
  font-weight: 400;
  font-size: 12px;
  line-height: 150%;
  letter-spacing: 0.2px;
  color: #81858e;
}
.blue-text {
  color: #2133d2;
  font-size: 14px;
  line-height: 17px;
  font-weight: 600;
}
.child-body {
  display: flex;
  justify-content: space-between;
}
.double-inputs {
  display: grid;
  grid-template-columns: 1fr 60px;
  gap: 5px;
  align-items: center;
  margin-bottom: 15px;
}
span {
  font-weight: bold;
}
.btn-right{
    display: flex;
    justify-content: flex-end;
    margin-right: 10px;
}
</style>