import ScheduleComponent from './components/ScheduleComponent.vue';
import ScheduleCreateComponent from './components/ScheduleCreateComponent.vue';
import ScheduleUpdateComponent from './components/ScheduleUpdateComponent.vue';

const routes = [
    {
        path: '/',
        name: 'list',
        component: ScheduleComponent
    },
    {
        path: '/contact/new',
        name: 'create',
        component: ScheduleCreateComponent
    },
    {
        path: '/contact/update/:id',
        name: 'edit',
        component: ScheduleUpdateComponent
    }
];

export default routes;
