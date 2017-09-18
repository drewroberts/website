import Home from './components/Home.vue';
import About from './components/About.vue';
import Backend from './components/Backend.vue';
import Frontend from './components/Frontend.vue';
import Marketing from './components/Marketing.vue';
import Analytics from './components/Analytics.vue';
import Tools from './components/Tools.vue';

export const routes = [
	{ path: '/', component: Home, name: 'Home' },
	{ path: '/about', component: About, name: 'About' },
	{ path: '/backend', component: Backend, name: 'Backend' },
	{ path: '/frontend', component: Frontend, name: 'Frontend' },
	{ path: '/marketing', component: Marketing, name: 'Marketing' },
	{ path: '/analytics', component: Analytics, name: 'Analytics' },
	{ path: '/tools', component: Tools, name: 'Tools' },
];