<template>
  <div>
    <p>{{ vendor }}</p>
        <form @submit.prevent="handleUpdate">
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
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';

  let vendorId= useRoute().params.id
  console.log(vendorId);
  let vendor=ref({})
  const baseUrl = import.meta.env.VITE_API_BASE_URL;
  const router = useRouter();
  const fetchVendor=()=>{
     axios.get(`${baseUrl}/vendors/${vendorId}`)
     .then(res=>{
         console.log(res);
         vendor.value= res.data.vendor
      
     })
     .catch(err=>{
        console.log(err);
     })
  }

  onMounted(()=>{
    fetchVendor()
  })

  
  const handleUpdate = ()=>{

    axios.put(`${baseUrl}/vendors/${vendorId}`,{
       vendor:vendor.value
    })
   .then(res=>{
         console.log(res);
         router.push('/vendors')
     })
     .catch(err=>{
        console.log(err);
     })
 }





</script>

<style>

</style>