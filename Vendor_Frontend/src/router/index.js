import { createRouter, createWebHistory } from 'vue-router'

import VendorList from '../pages/vendors/VendorList.vue'
import CreateVendor from '../pages/vendors/CreateVendor.vue'
import EditVendor from '../pages/vendors/EditVendor.vue'

const routes = [
  { path: '/', redirect: '/vendors' },
  { path: '/vendors', component: VendorList },
  { path: '/vendors/create', component: CreateVendor },
  { path: '/vendors/edit/:id', component: EditVendor },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
