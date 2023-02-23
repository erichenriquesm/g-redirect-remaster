<template>
  <div id="app">
    <router-view />
  </div>
</template>



<style lang="scss">
@import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,500;0,600;0,900;1,400&display=swap");
#app {
  font-family: "Montserrat", sans-serif;
  input {
    outline: none !important;
    border-radius: 5px;
  }
  .not-found {
    width: 80%;
    padding: 10px;
    margin: 10px auto;
    text-align: center;
    border: 1px solid rgba(0, 0, 0, 0.199);
    p {
      font-weight: 200;
      margin: 0px;
    }
  }
  .loading {
    width: 100%;
    display: flex;
    justify-content: center;
    margin: 20px 0px;
  }
  .container {
    width: 95% !important;
    margin-top: 10px;
  }
  .tab-header {
    margin: 20px 0;
  }
  .tab-body {
    padding: 5px;
  }
  .tab-body:nth-child(odd) {
    background: rgba(243, 234, 234, 0.37);
  }
  .page-link.active,
  .active > .page-link {
    z-index: 3;
    background-color: #45bf86 !important;
    border-color: #428c77 !important;
    color: white !important;
  }
  .page-link:focus {
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px !important;
  }
  .page-link {
    color: black !important;
    border-radius: 50% !important;
    margin-right: 5px !important;
    width: 33px;
    height: 33px;
    font-size: 13px;
  }
  .btn-right {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    margin: 15px 0;
  }
  .danger {
    margin: 10px 0;
  }
  .user-drop {
    position: absolute !important;
    bottom: -10px !important;
    left: -8px !important;
    width: 35px !important;
    height: 37px !important;
  }
  .user-drop #dropdown-dropright__BV_toggle_ {
    opacity: 0;
  }
  .dropdown-item {
    display: flex;
    align-items: center;
    transition: 0.3s;
  }
}
</style>
