import ListComponent from "@/components/List";
import DetailsComponent from "@/components/Details";

const routes = [
    {
        path: '/',
        component: ListComponent,
        meta: {title: 'List'},
    },
    {
        path: '/details',
        component: DetailsComponent,
        name: 'DetailsComponent',
        meta: {title: 'Details'}
    }
];

export default routes;
