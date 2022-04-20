import Vue from "vue";
import VueRouter from "vue-router";
import advancedResearch from './pages/advancedResearch';


Vue.use(VueRouter);

const router = new VueRouter({
    mode : 'history',
    routes : [
        {
            path: '/advancedResearch',
            component : advancedResearch,
            name : "apartments.index",
            meta : {title: "search", linkText: "advanced research"}
        }
    ]
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
  
    next();
  });

  export default router;