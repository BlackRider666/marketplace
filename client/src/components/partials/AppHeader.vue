<template>
  <div>
    <v-app-bar
        app
        :tile="false"
        fixed
        color="primary"
        dark
    >
      <router-link
          class="text-decoration-none pr-5"
          :to="{name:'dashboard'}"
      ><v-btn
        text
        rounded
        large
      ><span class="header__logo">LongPay</span>
      </v-btn>
      </router-link>
      <v-form
        ref="form"
        lazy-validation
        align="center"
        class="flex-fill"
      >
        <v-flex>
          <v-text-field
            v-model="searchString"
            label="Search"
            clearable
            outlined
            solo-inverted
            rounded
            hide-details
            append-icon="mdi-magnify"
            @click:append="helo"
            dense
          >
            <template slot="no-data">
              <v-list-item>
                <v-list-item-title>
                  Search
                </v-list-item-title>
              </v-list-item>
            </template>
          </v-text-field>
        </v-flex>
      </v-form>
      <v-btn text dark class="mx-2">Saving</v-btn>
      <v-btn
        color="red"
        outlined
        dense
        class="mx-2"
        >+100.00$
      </v-btn>
    <!--    <LanguageSwitcher/>-->
    <!--    <template v-if="isLoggedIn">-->
    <!--      <MenuList :options="accountOptions" @itemClicked="goToPage" />-->
    <!--    </template>-->
    </v-app-bar>
    <v-app-bar
      app
      fixed
      color="secondary"
      dark
      class="mt-16"
      dense
    >
      <v-container>
        <v-row>
          <v-col cols="3">
            <router-link
              class="text-decoration-none"
              :to="{name:'dashboard'}"
            ><v-btn
              text
              small
            >LongPay</v-btn>
            </router-link>
            <router-link
              class="text-decoration-none"
              :to="{name:'dashboard'}"
            ><v-btn
              text
              small
            >LongPay</v-btn>
            </router-link>
          </v-col>
          <v-col cols="6">
            <div class="text-center">
              {{pageTitle}}
            </div>
          </v-col>
          <v-col cols="3" class="text-end">
            <v-btn text small v-if="auth" :to="{name:'account'}">{{fullName}}</v-btn>
            <v-btn text small v-else>Log in</v-btn>
            <v-btn text small><v-icon>mdi-cart-outline</v-icon></v-btn>
            <v-btn text small><country-flag country="ua" class="my-auto"/></v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-app-bar>
  </div>
</template>

<script>
// import MenuList from './MenuList'
// import LanguageSwitcher from './LanguageSwitcher'
// import { mapState } from 'vuex'

export default {
  name: 'AppHeader',
  // components: { MenuList, LanguageSwitcher },
  data () {
    return {
      searchString: '',
      isUpdating: false,
      title: 'The summer breeze'
    }
  },
  watch: {
    isUpdating (val) {
      if (val) {
        setTimeout(() => (this.isUpdating = false), 3000)
      }
    }
  },
  methods: {
    helo () {
      console.log(this.searchString)
      console.log('Search')
    }
  },
  computed: {
    pageTitle () {
      return this.$route.meta.pageTitle
    },
    auth () {
      return this.$store.getters['auth/getAuthToken'] !== ''
    },
    fullName () {
      return this.$store.getters['account/getAccount'].full_name
    }
  }
}
</script>

<style scoped>
.header__logo {
  font-style: normal;
  text-transform: none;
  font-size: 26px;
  font-weight: bold;
}
.v-select.v-select--is-menu-active .v-input__icon--append .v-icon {
  transform: none;
}
</style>
