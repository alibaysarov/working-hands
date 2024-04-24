import Main from "../pages/Main.vue";
import AdvertismentPage from "../pages/AdvertismentPage.vue";
import NewAdvertisment from "../pages/NewAdvertisment.vue";

const routes = [
    {
        path: '/',
        component:Main,
        name:"index",
        props: (route) => ({ page: route.query.page })
    },
    {
        path: '/advertisment/:id',
        name: 'advertisment',
        component: AdvertismentPage
    },
    {
        path: '/advertisment/create',
        name: 'advertisment-create',
        component: NewAdvertisment
    },
]
export default routes
