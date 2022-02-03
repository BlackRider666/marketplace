<template>
  <v-app-bar
      app
      :tile="false"
      fixed
  >
    <router-link
        class="text-decoration-none"
        :to="{name:'dashboard'}"
    ><v-app-bar-nav-icon>{{$t('main.company-name', 'WRP')}}</v-app-bar-nav-icon>
    </router-link>
    <v-spacer/>
    <v-form
      class="d-inline-flex"
      ref="form"
      lazy-validation
      align="center"
      @submit.prevent="mainSearch"
    ><v-row no-gutters>
        <v-col cols="6">
          <v-text-field
              v-model="search"
              :placeholder="$t('search.placeholder', 'Search ...')"
              hide-details
              :rules="[rules.required]"
          />
        </v-col>
        <v-col cols="3">
          <v-select
              v-model="searchType"
              :items="types"
              :placeholder="$t('search.type.placeholder', 'Choose')"
              :item-text="(item) => $t('search.type.'+item.key, item.value)"
              hide-details
              :rules="[rules.required]"
              return-object
          ></v-select>
        </v-col>
        <v-col cols="3">
          <v-btn
              text
              type="submit"
          ><v-icon>mdi-magnify</v-icon></v-btn>
        </v-col>
      </v-row>
    </v-form>
    <router-link
        class="text-decoration-none"
        :to="{name:'Main Search', params:{type:'articles'}}"
    >
      <v-btn color="primary">{{$t('articles.index.title','Articles')}}</v-btn>
    </router-link>
    <v-spacer/>
    <template v-if="account.is_premium">
      <router-link
          class="text-decoration-none"
          :to="{name:'Create Article'}"
      >
        <v-btn v-if="isLoggedIn" color="primary" icon><v-icon>mdi-plus</v-icon></v-btn>
      </router-link>
      <div>{{$t('header.menu.premium-to','Premium to: ')+account.is_premium}}</div>
    </template>
    <v-divider vertical color="white" inset class="mr-2"></v-divider>
    <LanguageSwitcher/>
    <template v-if="isLoggedIn">
      <MenuList :options="accountOptions" @itemClicked="goToPage" />
    </template>
  </v-app-bar>
</template>

<script>
import MenuList from './MenuList'
import LanguageSwitcher from './LanguageSwitcher'
import { mapState } from 'vuex'

export default {
  name: 'AppHeader',
  components: { MenuList, LanguageSwitcher },
  data () {
    return {
      search: null,
      searchType: null,
      types: [
        {
          key: 'users',
          value: 'Users'
        },
        {
          key: 'articles',
          value: 'Articles'
        }
      ],
      rules: {
        required: value => !!value || 'Required.'
      }
    }
  },
  computed: {
    accountOptions () {
      let items = []
      if (this.$store.getters['account/getAccount'].roles.filter((item) => item.name === 'superadmin').length > 0 ||
          this.$store.getters['account/getAccount'].roles.filter((item) => item.name === 'conference creator').length > 0
      ) {
        items = [
          {
            title: this.account.full_name || '',
            divider: true,
            subtitleClass: 'text-center font-weight-bold',
            image: this.account.avatar_url || null
          },
          {
            titleTKey: 'header.menu.premium',
            titleTDefault: 'Premium',
            icon: 'mdi-account-outline',
            to: {
              name: 'Premium'
            },
            divider: true
          },
          {
            titleTKey: 'header.menu.account',
            titleTDefault: 'Account',
            icon: 'mdi-account-outline',
            to: {
              name: 'account'
            },
            divider: true
          },
          {
            titleTKey: 'header.menu.conferences',
            titleTDefault: 'Conferences',
            icon: 'mdi-book-open-variant',
            to: {
              name: 'Conferences'
            },
            divider: true
          },
          {
            titleTKey: 'header.menu.articles',
            titleTDefault: 'Articles',
            icon: 'mdi-book-open-variant',
            to: {
              name: 'Articles'
            },
            divider: true
          },
          {
            titleTKey: 'header.menu.logout',
            titleTDefault: 'Logout',
            icon: 'mdi-logout',
            to: {
              name: 'logout'
            }
          }
        ]
      } else {
        items = [
          {
            title: this.account.full_name || '',
            divider: true,
            subtitleClass: 'text-center font-weight-bold',
            image: this.account.avatar_url || null
          },
          {
            titleTKey: 'header.menu.premium',
            titleTDefault: 'Premium',
            icon: 'mdi-account-outline',
            to: {
              name: 'Premium'
            },
            divider: true
          },
          {
            titleTKey: 'header.menu.account',
            titleTDefault: 'Account',
            icon: 'mdi-account-outline',
            to: {
              name: 'account'
            },
            divider: true
          },
          {
            titleTKey: 'header.menu.articles',
            titleTDefault: 'Articles',
            icon: 'mdi-book-open-variant',
            to: {
              name: 'Articles'
            },
            divider: true
          },
          {
            titleTKey: 'header.menu.logout',
            titleTDefault: 'Logout',
            icon: 'mdi-logout',
            to: {
              name: 'logout'
            }
          }
        ]
      }
      return {
        items: items,
        titleClass: 'v-avatar _max-h-46 _w-auto',
        titleIcon: 'mdi-account-outline',
        showArrow: true,
        openOnHover: false,
        badgeContent: null,
        badgeValue: true,
        nudgeBottom: 45
      }
    },
    isLoggedIn () {
      return this.$store.getters['auth/getAuthToken'].length > 0
    },
    ...mapState({
      account: state => state.account.user
    })
  },
  mounted () {
  },
  methods: {
    goToPage ({ pageName, action }) {
      if (pageName) this.$router.push({ name: pageName })
      if (action) action()
    },
    mainSearch (e) {
      e.preventDefault()
      e.stopPropagation()
      if (!this.$refs.form.validate()) return
      this.$router.push({ name: 'Main Search', params: { type: this.searchType.key }, query: { title: this.search } })
    }
  }
}
</script>

<style scoped>

</style>
