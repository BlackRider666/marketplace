<template>
  <div style="height: 100%">
    <AppHeader />
    <v-main class="main-content">
      <v-container>
        <router-view />
      </v-container>
      <Footer :text="$t('footer.all-reserved', 'All rights reserved')"/>
    </v-main>
  </div>
</template>

<script>
import AppHeader from '@/components/partials/AppHeader'
import Footer from '@/components/partials/Footer'

export default {
  name: 'Main',
  components: { AppHeader, Footer },
  data () {
    return {
    }
  }
}
</script>

<style scoped>

</style>
