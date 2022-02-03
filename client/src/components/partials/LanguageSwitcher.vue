<template>
  <v-menu
      :open-on-click="true"
      :close-on-click="true"
      :close-on-content-click="true"
      left
      :nudge-bottom="30"
      ref="locale"
  >
    <template v-slot:activator="{ on }">
      <div class="font-weight-medium px-1" v-on="on">
        <v-badge
            color="primary"
            :value="null"
        >
          <span v-if="activeLocale.iso_code" v-html="activeLocale.iso_code"></span>
        </v-badge>
        <v-icon>mdi-chevron-down</v-icon>
      </div>
    </template>
    <v-list avatar class="py-0">
      <v-list-item-group class="px-2 py-1">
        <div v-for="item in locales"
             :key="item.id">
          <v-list-item
              class="my-1"
              @click="changeLanguage(item)"
          >
            <v-list-item-content>
              <v-list-item-subtitle v-if="item.name" v-html="item.name"></v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-divider/>
        </div>
      </v-list-item-group>
    </v-list>
  </v-menu>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'LanguageSwitcher',
  computed: {
    LanguageOptions: function () {
      return {
        items: this.$store.state.l10s.locales,
        titleClass: 'subtitle-1',
        titleTKey: this.l10s.locale,
        titleColor: 'primary'
      }
    },
    ...mapState({
      locales: (state) => state.l10s.locales,
      activeLocale: (state) => state.l10s.locale
    })
  },
  methods: {
    changeLanguage (language) {
      this.$loading()
      this.$store.dispatch('l10s/setActiveLocale', language)
        .then((result) => {
          if (result) {
            this.l10s.onUntranslatedKeyFound((key, value) => {
              this.$store.dispatch('l10s/createNewTranslationKey', {
                key,
                value,
                iso_code: this.$store.getters['l10s/getActiveLocale'].iso_code
              })
            })
          }
          this.$loadingClose()
        })
    }
  }
}
</script>

<style scoped>

</style>
