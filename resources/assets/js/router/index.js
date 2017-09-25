import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from '../views/Auth/Login.vue'
import Register from '../views/Auth/Register.vue'
import UserIndex from '../views/User/Index.vue'
import UserShow from '../views/User/Show.vue'
import UserForm from '../views/User/Form.vue'
import NotFound from '../views/NotFound.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [
		{ path: '/', component: UserIndex },
		{ path: '/users/create', component: UserForm, meta: { mode: 'create' }},
		{ path: '/users/:id/edit', component: UserForm, meta: { mode: 'edit' }},
		{ path: '/users/:id', component: UserShow },
		{ path: '/register', component: Register },
		{ path: '/login', component: Login },
		{ path: '/not-found', component: NotFound },
		{ path: '*', component: NotFound }
	]
})

export default router
