<template>
  <v-container fluid fill-height style="background-color: rgba(255, 255, 255, 0.7);">
    <v-layout flex column justify-center align-center>
      <div>
        <v-img src="logo.png" width="50px" class="mb-4" />
      </div>
      <v-progress-circular
          :size="50"
          color="primary"
          indeterminate
      ></v-progress-circular>
      <div class="pt-4 title">{{$t('loading.please-waiting', 'Please waiting')}}</div>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: 'Loading'
}
</script>

<style scoped>

</style>
