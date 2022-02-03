<template>
  <v-main class="default--layout bg-img">
    <v-container fluid class="fill-height">
      <v-row align="center" justify="center">
        <router-view></router-view>
      </v-row>
    </v-container>
  </v-main>
</template>

<script>
export default {
  name: 'Auth'
}
</script>

<style scoped>

</style>
