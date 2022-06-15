<template>
  <v-col cols="12" class="pt-0 dashboard">
    <h1 class="text-center">You don`t have access for this!
      <br>
      <router-link :to="{name:'dashboard'}">Back</router-link>
    </h1>

  </v-col>
</template>

<script>
export default {
name: "Error403"
}
</script>

<style scoped>

</style>