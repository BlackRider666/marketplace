<template>
  <v-form
    ref="form"
    lazy-validation
    @submit="updateLocation"
  >
    <v-row dense class="pt-5">
      <v-col cols="12">
        <v-autocomplete
          v-model="location.country_id"
          :items="countries"
          item-text="name"
          item-value="id"
          :label="$t('article.placeholder.country','Country')"
          prepend-inner-icon="mdi-database-search"
          outlined
          :rules="[rules.required]"
        ></v-autocomplete>
      </v-col>
      <v-col cols="12">
        <v-autocomplete
          v-model="location.region_id"
          :items="regions"
          item-text="name"
          item-value="id"
          :label="$t('article.placeholder.region','Region')"
          prepend-inner-icon="mdi-database-search"
          outlined
          :rules="[rules.required]"
          :loading="loadingRegions"
          :disabled="loadingRegions"
        ></v-autocomplete>
      </v-col>
      <v-col cols="12">
        <v-autocomplete
          v-model="location.city_id"
          :items="cities"
          item-text="name"
          item-value="id"
          :label="$t('article.placeholder.city','City')"
          prepend-inner-icon="mdi-database-search"
          outlined
          :rules="[rules.required]"
          :loading="loadingCities"
          :disabled="loadingRegions || loadingCities"
        ></v-autocomplete>
      </v-col>
      <v-col cols="12">
        <v-text-field
          v-model="location.address"
          :label="$t('placeholder.address', 'Address')"
          outlined
          prepend-inner-icon="mdi-account-outline"
          :rules="[rules.required]"
        />
      </v-col>
      <v-col cols="4" offset="4">
        <v-btn
          color="primary"
          class="mt-2"
          rounded
          block
          type="submit"
        >{{$t('btn.update','Update')}}</v-btn>
      </v-col>
    </v-row>
  </v-form>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'AccountLocation',
  data () {
    return {
      rules: {
        required: value => !!value || 'Required.'
      },
      loadingRegions: false,
      loadingCities: false
    }
  },
  mounted () {
    this.$loading()
    this.$store.dispatch('location/downloadLocation')
    this.$store.dispatch('location/downloadCountries').then(() => {
      this.$loadingClose()
    })
  },
  computed: {
    ...mapState({
      location: (state) => state.location.location,
      countries: (state) => state.location.countries,
      regions: (state) => state.location.regions,
      cities: (state) => state.location.cities
    })
  },
  methods: {
    loadRegions (id) {
      this.loadingRegions = true
      this.$store.dispatch('location/downloadRegions', id).then(() => {
        this.loadingRegions = false
      }).catch(() => {
        this.loadingRegions = false
      })
    },
    clearRegions () {
      this.$store.dispatch('location/clearRegions')
    },
    loadCities (id) {
      this.loadingCities = true
      this.$store.dispatch('location/downloadCities', id).then(() => {
        this.loadingCities = false
      }).catch(() => {
        this.loadingCities = false
      })
    },
    clearCities () {
      this.$store.dispatch('location/clearCities')
    },
    updateLocation (e) {
      e.preventDefault()
      e.stopPropagation()
      console.log('Update location', this.location)
    }
  },
  watch: {
    'location.country_id' (id) {
      if (id) {
        this.loadRegions(id)
        this.clearCities()
      } else {
        this.clearRegions()
      }
    },
    'location.region_id' (id) {
      if (id) {
        this.loadCities(id)
      } else {
        this.clearCities()
      }
    }
  }
}
</script>

<style scoped>

</style>
