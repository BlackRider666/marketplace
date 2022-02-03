<template>
  <div style="height: 100%">
    <AppHeader />
    <v-main class="main-content">
      <v-container fluid class="px-0">
        <v-row>
          <v-col cols="12" class="py-0">
            <Breadcrumbs/>
            <router-view />
          </v-col>
        </v-row>
      </v-container>
      <Footer :text="$t('footer.all-reserved', 'All rights reserved')"/>
    </v-main>
  </div>
</template>

<script>
import AppHeader from '@/components/partials/AppHeader'
import Breadcrumbs from '@/components/partials/Breadcrumbs'
import Footer from '@/components/partials/Footer'

export default {
  name: 'Main',
  components: { AppHeader, Breadcrumbs, Footer },
  data () {
    return {
    }
  }
}
</script>

<style scoped>

</style>
