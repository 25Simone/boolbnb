import Vue from "vue";
import VueRouter from "vue-router";
import AdvancedSearch from './pages/AdvancedSearch';


Vue.use(VueRouter);

const router = new VueRouter({
    mode : 'history',
    routes : [
        {
            path: '/advancedSearch',
            component : AdvancedSearch,
            name : "advancedSearch",
            meta : {title: "search", linkText: "advanced research"}
        }
    ]
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
  
    next();
  });

  export default router;