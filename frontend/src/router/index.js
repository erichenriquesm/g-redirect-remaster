import Vue from 'vue';
import VueRouter from 'vue-router';
import LoginView from '../views/LoginView.vue';
import CadastroView from '../views/CadastroView.vue';
import DashboardView from '../views/DashboardView.vue';
import RedirectView from '../views/RedirectView.vue';

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Redirect',
    component: RedirectView
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: DashboardView
  },
  {
    path: '/login',
    name: 'Login',
    component: LoginView
  },
  {
    path: '/cadastro',
    name: 'Cadastro',
    component: CadastroView
  },

]
const router = new VueRouter({
  mode: "history",
  routes
});


export default router
