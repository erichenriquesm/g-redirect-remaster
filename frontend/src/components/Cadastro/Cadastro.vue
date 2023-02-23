<template>
  <div class="grid-2">
    <b-form-group v-if="!loading" class="form">
      <h4>Cadastro</h4>
      <label>Name</label>
      <b-form-input
        id="email"
        v-model="name"
        placeholder="Digite seu Nome"
      ></b-form-input>
      <p v-if="!nameLgth" class="danger">Digite seu nome</p>
      <label for="email">E-mail</label>
      <b-form-input
        id="email"
        v-model="email"
        placeholder="Digite seu E-mail"
      ></b-form-input>
      <p v-if="!validEmail" class="danger">Digite um e-mail válido</p>
      <label for="senha">Senha</label>
      <b-form-input
        id="senha"
        v-model="senha"
        placeholder="Digite sua senha"
      ></b-form-input>
      <p v-if="!validSenha" class="danger">A senha precisa ter no mínimo 6 digitos</p>
      <p v-if="warn" class="danger">Erro ao cadastrar, volte mais tarde</p>
      <div class="btn-right">
        <BaseButton @click="$router.push('/login')" variant="info"
          >Login</BaseButton
        >
        <BaseButton @click="onSubmit" variant="primary">Cadastre-se</BaseButton>
      </div>
    </b-form-group>
    <div class="loading" v-if="loading">
      <b-spinner></b-spinner>
    </div>
    <img
      src="https://wallpapershome.com/images/pages/pic_h/24117.jpg"
      alt="img"
    />
  </div>
</template> 

<script>
import axios from "axios";
import BaseButton from "@/components/BaseButton.vue";
export default {
  data() {
    return {
      name: "",
      email: "",
      senha: "",
      nameLgth: true,
      validEmail: true,
      validSenha: true,
      warn: false,
      loading: false,
    };
  },
  components: {
    BaseButton,
  },
  methods: {
    onSubmit() {
      var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
      if(!this.name.length){
        this.nameLgth = false;
        return;
      }
      this.nameLgth = true;
      if (!this.email.match(emailRegex)) {
        this.validEmail = false;
        return;
      }
      this.validEmail = true;
      if (!this.senha.length || this.senha.length < 6) {
        this.validSenha = false;
        return;
      }
      this.validSenha = true;
      let data = {
        name: this.name,
        email: this.email,
        password: this.senha,
      };
      var that = this;
      this.loading = true;
      axios
        .post("http://localhost:8000/api/register", data)
        .then((resp) => {
          if (resp.data.authorisation.token) {
            localStorage.setItem("user", JSON.stringify(resp.data));
            this.$router.push("/dashboard");
            that.warn = false;
          }
        })
        .catch(() => {
          that.warn = true;
        })
        .finally(() => {
          that.loading = false;
        });
    },
  },
  mounted() {
    if (localStorage.getItem("user")) {
      this.$router.push("/dashboard");
    }
  },
};
</script>

<style scoped lang="scss">
.grid-2 {
  display: grid;
  grid-template-columns: 1fr 1fr;
}
img {
  width: 100%;
  height: 100vh;
  object-fit: cover;
}
.form {
  padding: 10px;
  width: 90%;
  height: fit-content;
  margin: 0 auto;
}
label {
  margin: 10px 0;
  font-weight: 600;
}
.forgot {
  text-decoration: none;
  margin: 10px 0 !important;
  display: flex;
  justify-content: flex-end;
}
.danger {
  color: red;
}
</style>