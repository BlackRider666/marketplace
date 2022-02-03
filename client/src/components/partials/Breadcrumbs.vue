<template>
  <div v-if="$route.meta && 'pageTitle' in $route.meta">
    <div class="d-flex align-center px-3 breadcrumbs">
      <div class="title text--text pr-3" v-if="$route.meta && 'pageTitle' in $route.meta">{{$t($route.meta.pageTitle, 'PageTitle')}}</div>
      <v-divider vertical v-if="$route.meta && 'pageTitle' in $route.meta"></v-divider>
      <v-breadcrumbs class="pl-2" :items="navItems">
        <template v-slot:divider>
          <v-icon>mdi-chevron-double-right</v-icon>
        </template>
        <template v-slot:item="{ item }">
          <v-breadcrumbs-item
              :to="item.to"
              :exact="true"
          >
            <template v-if="item.to == '/'">
              <v-icon color="primary" class="icon-home">mdi-home-outline</v-icon>
            </template>
            <template v-else>
              {{ $t(item.title, item.title) }}
            </template>
          </v-breadcrumbs-item>
        </template>
      </v-breadcrumbs>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Breadcrumbs',
  computed: {
    navItems () {
      return this.$route.meta.breadcrumb
    }
  }
}
</script>

<style scoped>

</style>
