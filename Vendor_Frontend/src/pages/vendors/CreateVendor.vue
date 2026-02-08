<template>
   <div>
      <!-- Header -->
    <div class="page-header">
      <h1>Create Vendor</h1>

      <router-link to="/vendors" class="btn btn-secondary">
        ← Back to List
      </router-link>
    </div>

    <!-- Success Message -->
    <div v-if="successMessage" class="alert-success">
      {{ successMessage }}
    </div>

   <p>{{ vendor }}</p>
   <form @submit.prevent="handleCreate">
       <div>
        <label for="name">Name</label>
        <input type="text" name="name" v-model="vendor.name">
       </div>
       <div>
        <label for="email">Email</label>
        <input type="text" name="email"  v-model="vendor.email">
       </div>
       <div>
        <label for="phone">Phone</label>
        <input type="text" name="phone"  v-model="vendor.phone">
       </div>
       <div>
        <label for="address">Address</label>
        <input type="text" name="address"  v-model="vendor.address">
       </div>
       <div> <button type="submit">Submit</button></div>
   </form>
 </div>
</template>

<script  setup>
import axios from 'axios';
import { computed, reactive } from 'vue';
import { useRouter } from 'vue-router';

const baseUrl = import.meta.env.VITE_API_BASE_URL;
const router= useRouter()
let vendor= reactive({
   name:"",
   email:"",
   phone:"",
   address:""
})

const Name= computed(()=>{
    return vendor.name
})

function handleCreate(){
   axios.post(`${baseUrl}/vendors`,
     vendor
   )
   .then(res=>{
     console.log(res);
     router.push("/vendors")
     
   })
   .catch(error => {
     console.error("Error creating vendor:", error);
   })
}

</script>

<style>

</style>