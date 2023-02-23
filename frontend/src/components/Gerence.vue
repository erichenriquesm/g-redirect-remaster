<template>
  <div>
    <b-modal
      class="m-2"
      hide-header
      hide-footer
      size="xl"
      id="gerence"
      @shown="openModal"
    >
      <div class="header">
        <div>
          <h1 class="title">Links de Redirecionamento 🌐</h1>
          <p>Crie seus links de redirect em poucos passos</p>
        </div>
        <BaseButton variant="info-light" v-b-toggle.sidebar-link
          >Criar um link</BaseButton
        >
      </div>
      <div class="body mt-4">
        <div>
          <div class="sub-header header pt-4 mb-4">
            <p class="blue-text">
              {{ links.length < 10 ? `0${links.length}` : links.length }} links
            </p>
            <p>Clique em tempo real</p>
          </div>
          <div>
            <div v-if="!loading && links.length">
              <div
                :class="{ active: active == index }"
                @click="selectLink(item, index)"
                class="link mt-3"
                v-for="(item, index) in links"
                :key="index"
              >
                <div class="d-flex">
                  <p>{{ item.name }}</p>
                  <p>{{ item.created_at | date }}</p>
                </div>
                <div class="header">
                  <p>{{ item.link }}</p>
                  <p>
                    👉
                    {{ item.clicks < 10 ? `0${item.clicks}` : item.clicks }}/{{
                      item.max_clicks < 10
                        ? `0${item.max_clicks}`
                        : item.max_clicks
                    }}
                  </p>
                </div>
              </div>
            </div>
            <div v-if="loading" class="spinner">
              <b-spinner></b-spinner>
            </div>
          </div>
        </div>
        <div v-if="selected_link">
          <div class="header-info mt-4 pl-2 pr-2">
            <h1 class="link-title">{{ selected_link.name }}</h1>
            <p>
              Criado em {{ selected_link.created_at | date }} às
              {{ selected_link.created_at | time }}
            </p>
          </div>
          <div class="link-actions title-info mb-4">
            <p class="blue-text mt-3" id="link">{{ selected_link.link }}</p>
            <BaseButton variant="outline-info" @click="copy">Copiar</BaseButton>
            <BaseButton variant="outline-info">Editar</BaseButton>
          </div>
          <div
            v-for="(item, index) in selected_link.childs"
            :key="index"
            class="child-body"
          >
            <div>
              <div class="d-flex">
                <p class="blue-text">
                  {{ index + 1 < 10 ? `0${index + 1}` : index + 1 }}
                </p>
                <p>{{ item.link }}</p>
              </div>
              <p class="blue-text">
                {{ item.clicks < 10 ? `0${item.clicks}` : item.clicks }}/{{
                  item.max_clicks < 10 ? `0${item.max_clicks}` : item.max_clicks
                }}
              </p>
            </div>

            <BaseButton class="child-button" variant="outline-info"
              >Editar</BaseButton
            >
          </div>
        </div>
      </div>
      <Sidebar />
    </b-modal>
  </div>
</template>

<script>
import BaseButton from "@/components/BaseButton";
import MiddlewareService from "@/services/MiddlewareService";
import Sidebar from "@/components/Sidebar.vue";
import moment from "moment";
export default {
  data() {
    return {
      links: [],
      loading: false,
      active: -1,
      selected_link: null,
    };
  },
  components: {
    BaseButton,
    Sidebar,
  },
  filters: {
    date: function (date) {
      return moment(date).format("DD/MM/YYYY");
    },
    time: function (date) {
      return moment(date).format("HH:ss");
    },
  },
  methods: {
    openModal() {
      this.fetchLinks();
    },
    fetchLinks() {
      var that = this;
      that.loading = true;
      MiddlewareService.get("/link")
        .then((resp) => {
          that.links = resp.data.data;
        })
        .finally(() => {
          that.loading = false;
        });
    },
    selectLink(link, index) {
      this.active = index;
      this.selected_link = link;
    },
    copy() {
      const link = document.querySelector("#link");
      const storage = document.createElement("textarea");
      storage.value = link.innerHTML;
      link.appendChild(storage);
      storage.select();
      storage.setSelectionRange(0, 99999);
      document.execCommand("copy");
      link.removeChild(storage);
    },
  },
};
</script>

<style scoped lang="scss">
* {
  font-family: Montserrat;
}
.title {
  font-size: 18px;
  font-weight: 600;
  line-height: 22px;
  letter-spacing: 0.20000000298023224px;
  text-align: left;
}
.link-title {
  font-size: 20px;
  font-weight: 600;
  line-height: 24px;
  letter-spacing: 0em;
  text-align: left;
}
p {
  font-size: 14px;
  font-weight: 400;
  line-height: 17px;
  letter-spacing: 0.20000000298023224px;
  text-align: left;
  margin-right: 10px;
}
.header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.body {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  border-top: 1px solid #ededf0;
}
.sub-header {
  border-bottom: 1px solid #ededf0;
  padding: 10px;
}
.blue-text {
  color: #2133d2;
  font-size: 16px;
  font-weight: 400;
  line-height: 17px;
}
.link {
  border-bottom: 1px solid #ededf0;
  cursor: pointer;
}
.spinner {
  display: flex;
  justify-content: center;
}
.active {
  color: #2133d2 !important;
  border-bottom: 1px solid #2133d2 !important;
}
.link-actions {
  display: flex;
  align-items: center;
  gap: 15px;
}
.title-info {
  border-bottom: 1px solid #ededf0;
}
.child-body {
  display: flex;
  justify-content: space-between;
  margin-bottom: 15px;
}
.child-button {
  margin-top: -7px;
}
.header-info {
  display: flex;
  align-items: center;
  gap: 10px;
  p {
    margin-top: 10px;
  }
}
</style>