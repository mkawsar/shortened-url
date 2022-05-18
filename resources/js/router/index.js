import Vue from "vue";
import VueRouter from "vue-router";

import routes from "./routes";

Vue.use(VueRouter);

const router = createRouter();

export default router

function createRouter() {
    const router = new VueRouter({
        mode: 'history',
        routes,
        linkActiveClass: 'active'
    });

    return router
}
