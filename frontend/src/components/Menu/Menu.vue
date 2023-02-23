<template>
  <div class="menu">
    <div @click="openModal('gerence')" class="item">
      <img class="opt" src="@/assets/icons/gift.svg" alt="gift" />
    </div>
    <div class="item">
      <img class="opt" src="@/assets/icons/school.svg" alt="opt" />
    </div>
    <div class="item">
      <img class="opt" src="@/assets/icons/trof.svg" alt="opt" />
    </div>
    <div class="item">
      <img class="opt" src="@/assets/icons/user.svg" alt="opt" />
    </div>
    <div class="item">
      <img class="opt" src="@/assets/icons/message.svg" alt="opt" />
    </div>
    <div class="user-icon">
      <b-dropdown
        id="dropdown-dropright"
        dropup
        text=""
        variant="primary"
        class="m-2 user-drop"
      >
        <b-dropdown-item @click="logout" class="log-out">
          <img  src="@/assets/icons/log-out.svg" alt="opt" />
          Logout</b-dropdown-item
        >
      </b-dropdown>
    </div>
    <Gerence/>
  </div>
</template>

<script>
import Gerence from "@/components/Gerence";
export default {
  data() {
    return {};
  },
  components: {
    Gerence,
  },
  methods: {
    openModal(modal){
      this.$bvModal.show(modal);
    },
    logout() {
      localStorage.clear();
      this.$router.push('/login');
    },
  },
};
</script>

<style scoped lang="scss">
.menu {
  width: 100px;
  border: 1px solid rgb(209, 208, 208);
  height: 100vh;
  padding: 10px;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
  transition: 0.5s width;
  position: sticky;
  top: 0;
  .user-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    position: absolute;
    bottom: 40px;
    margin: 0px 20%;
    background: rgba(129, 133, 142, 0.2);
    border: 1px solid #81858e;
  }
}
.logo {
  width: 45px;
  height: 45px;
}
.header-icon {
  width: 100%;
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
  cursor: pointer;
}
.item {
  cursor: pointer;
  margin-top: 50px;
}
.info {
  display: none;
  font-size: 14px;
  margin: 0;
}
.selected {
  svg,
  p {
    color: #45bf86;
  }
}
.opt {
  display: block;
  margin: 0 auto;
}
</style>
