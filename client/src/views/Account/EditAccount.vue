<template>
  <v-card>
    <v-card-text>
      <v-tabs right v-model="tab">
        <v-tab key="info">
          <v-icon left>
            mdi-account
          </v-icon>
          Information
        </v-tab>
        <v-tab key="location">
          <v-icon left>
            mdi-location
          </v-icon>
          Location
        </v-tab>
      </v-tabs>
      <v-tabs-items v-model="tab">
        <v-tab-item key="info">
          <EditInformation/>
        </v-tab-item>
        <v-tab-item key="location">
          <AccountLocation/>
        </v-tab-item>
      </v-tabs-items>
    </v-card-text>
  </v-card>
</template>

<script>
import EditInformation from './EditInformation'
import AccountLocation from './AccountLocation'

export default {
  name: 'EditAccount',
  components: { EditInformation, AccountLocation },
  data () {
    return {
      tab: 'location'
    }
  }
}
</script>

<style scoped>

</style>
