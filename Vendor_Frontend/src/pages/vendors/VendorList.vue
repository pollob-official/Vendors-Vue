<template>
    <div class="page-wrapper">

        <!-- Header -->
        <div class="page-header">
            <!-- Line 1 -->
            <h1 class="page-title">Vendor List</h1>

            <div class="header-actions-row">
                <router-link to="/vendors/create" class="btn btn-success">
                    ➕ Add New Vendor
                </router-link>

                <!-- <input type="text" class="search-input" placeholder="🔍 Search vendor by name..." v-model="search" /> -->
            </div>
        </div>

        <!-- Table -->
        <div class="table-wrapper">
            <table class="farmer-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th width="140">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="vendor in vendors" :key="vendor.id">
                        <td>{{ vendor.id }}</td>
                        <td>{{ vendor.name }}</td>
                        <td>{{ vendor.phone }}</td>
                        <td>{{ vendor.email ?? '-' }}</td>
                        <td>{{ vendor.address ?? '-' }}</td>

                        <td class="actions">
                            <router-link :to="`/vendors/edit/${vendor.id}`" class="btn btn-sm btn-primary">
                                Edit
                            </router-link>

                            <button class="btn btn-sm btn-danger" @click="deleteVendor(vendor.id)">
                                Delete
                            </button>
                        </td>
                    </tr>

                    <tr v-if="searchVendor.length === 0">
                        <td colspan="6" class="no-data">
                            No vendors found
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script setup>
import axios from 'axios'
import { computed, onMounted, ref } from 'vue'

const baseUrl = import.meta.env.VITE_API_BASE_URL

const vendors = ref([])
const search = ref("")

const searchVendor = computed(() => {
    let q = search.value.trim().toLowerCase()
    if (!q) return vendors.value

    return vendors.value.filter((vendor) => {
        return vendor.name?.trim().toLowerCase().includes(q)
    })
})

const fetchVendors = () => {
    axios.get(`http://127.0.0.1:8000/api/vendors`)
        .then(response => {
            console.log(response.data)
            vendors.value = response.data.vendors
        })
        .catch(error => {
            console.error("Error fetching vendors:", error)
        })
}

onMounted(() => {
    fetchVendors()
})

function deleteVendor(id) {
    axios.delete(`http://127.0.0.1:8000/api/vendors/${id}`)
        .then(response => {
            console.log(response)
            fetchVendors()
        })
        .catch(error => {
            console.log(error)
        })
}
</script>

<style></style>