<template>
  <v-footer
      class="font-weight-medium"
      dark
      color="primary"
  >
    <v-col
        class="text-left"
        cols="12"
    >
      <span class="text-uppercase">Copyright</span> @ {{`2021 - ${new Date().getFullYear()}` }}
    </v-col>
  </v-footer>
</template>

<script>
export default {
  name: 'Footer'
}
</script>

<style scoped>

</style>
