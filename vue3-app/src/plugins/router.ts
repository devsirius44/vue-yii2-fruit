import { createRouter, createWebHashHistory, RouteRecordRaw } from "vue-router";
import HomeLayout from "../pages/home/HomeLayout.vue";
import HomePage from "../pages/home/HomePage.vue";
import FavoritesPage from "../pages/home/FavoritesPage.vue";
const routes: RouteRecordRaw[] = [
  {
    path: "/",
    component: HomeLayout,
    redirect: "/home",
    children: [
      {
        path: "/home",
        component: HomePage,
      },
      {
        path: "/favorites",
        component: FavoritesPage,
      },
    ],
  },
];

export default createRouter({
  history: createWebHashHistory(),
  routes,
});
