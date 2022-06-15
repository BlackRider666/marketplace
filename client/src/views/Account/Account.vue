<template>
  <v-row>
    <v-container>
      <v-tabs left v-model="tab">
        <v-tab key="statistics">
          <v-icon left>
            mdi-finance
          </v-icon>
          Statistics
        </v-tab>
        <v-tab key="account">
          <v-icon left>
            mdi-account
          </v-icon>
          Account
        </v-tab>
      </v-tabs>
      <v-tabs-items v-model="tab">
        <v-tab-item key="statistics">
          <Statistics/>
        </v-tab-item>
        <v-tab-item key="account">
          <EditAccount/>
        </v-tab-item>
      </v-tabs-items>
    </v-container>
  </v-row>
</template>

<script>
import Statistics from './Statistics'
import EditAccount from './EditAccount'

export default {
  name: 'Account',
  components: {
    Statistics,
    EditAccount
  },
  data () {
    return {
      tab: 'statistics'
    }
  },
  mounted () {
    this.$store.dispatch('account/downloadAccount')
  }
}
</script>

<style scoped>

</style>
