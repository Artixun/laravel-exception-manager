export default [
    {path: '/', redirect: '/exceptions'},

    {
        path: '/exceptions',
        name: 'exceptions',
        component: require('./components/Index')
    },

    {
        path: '/exceptions/:id',
        name: 'exception-preview',
        component: require('./components/Preview')
    }
];
