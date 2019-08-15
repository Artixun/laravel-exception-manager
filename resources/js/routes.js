export default [
    {path: '/', redirect: '/exceptions'},

    {
        path: '/exceptions',
        name: 'exceptions',
        component: require('./components/Index')
    }
];
