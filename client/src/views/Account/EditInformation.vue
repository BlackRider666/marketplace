<template>
  <v-row dense class="pt-5" v-if="user">
    <v-col cols="3" class="text-center">
      <v-img :src="user.avatar" width="140pt" height="140pt" class="rounded-circle mx-auto mb-2"/>
      <p>Добавить/изменить {{isCompany ? "логотип компании":"фотографию"}}</p>
    </v-col>
    <v-col cols="9">
      <v-form
        ref="form"
        lazy-validation
        @submit="updateInformation"
      >
        <v-row dense>
          <template v-if="isCompany">
            <v-col cols="12">
              <v-text-field
                v-model="user.first_name"
                :label="$t('placeholder.name', 'Name')"
                outlined
                prepend-inner-icon="mdi-account-outline"
                :rules="[rules.required]"
              />
            </v-col>
          </template>
          <template v-else>
            <v-col cols="12">
              <v-text-field
                v-model="user.first_name"
                :label="$t('placeholder.name', 'Name')"
                outlined
                prepend-inner-icon="mdi-account-outline"
                :rules="[rules.required]"
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="user.second_name"
                :label="$t('placeholder.second_name', 'Second Name')"
                outlined
                prepend-inner-icon="mdi-account-outline"
                :rules="[rules.required]"
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="user.surname"
                :label="$t('placeholder.surname', 'Surname')"
                outlined
                prepend-inner-icon="mdi-account-outline"
                :rules="[rules.required]"
              />
            </v-col>
          </template>
          <v-col cols="6">
            <v-text-field
              v-model="user.phone"
              :label="$t('placeholder.phone', 'Phone')"
              outlined
              prepend-inner-icon="mdi-phone"
              :rules="[rules.required, rules.phone]"
            />
          </v-col>
          <v-col cols="6">
            <v-text-field
              v-model="user.email"
              outlined
              prepend-inner-icon="mdi-email-outline"
              :label="$t('placeholder.email', 'Email')"
              :rules="[rules.required, rules.email]"
              type="email"
            />
          </v-col>
          <template v-if="isCompany">
            <v-col cols="12">
              <v-text-field
                v-model="user.company.code"
                :label="$t('placeholder.code', 'Code')"
                outlined
                prepend-inner-icon="mdi-account-outline"
                :rules="[rules.required]"
              />
            </v-col>
          <v-col cols="12">
            <v-text-field
              v-model="user.company.site"
              :label="$t('placeholder.site', 'Site')"
              outlined
              prepend-inner-icon="mdi-web"
              :rules="[rules.required, rules.site]"
            />
          </v-col>
          <v-col cols="12">
            <v-text-field
              v-model="user.company.contact_person"
              outlined
              prepend-inner-icon="mdi-email-outline"
              :label="$t('placeholder.contact_person', 'Contact person')"
              :rules="[rules.required]"
              type="email"
            />
          </v-col>
          <v-col cols="12">
            <v-autocomplete
              v-model="user.company.direction"
              :items="directions"
              hide-no-data
              item-text="name"
              item-value="id"
              :label="$t('works.placeholder.direction','Direction')"
              :placeholder="$t('works.placeholder.direction','Direction')"
              prepend-inner-icon="mdi-database-search"
              :search-input="directionSearch"
              @update:search-input="(value) => changeDirection(value)"
              return-object
              outlined
            ></v-autocomplete>
          </v-col>
          <v-col cols="12">
            <v-textarea
              v-model="user.company.desc"
              :label="$t('placeholder.desc', 'About')"
              color="primary"
              outlined
            ></v-textarea>
          </v-col>
          </template>
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
    </v-col>
  </v-row>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'EditInformation',
  data () {
    return {
      user: null,
      directionSearch: '',
      rules: {
        required: value => !!value || 'Required.',
        min: v => v.length >= 8 || 'Min 8 characters',
        email: value => {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(value) || 'Invalid e-mail.'
        },
        confirmation: v => v === this.user.password || 'Password mismatch',
        phone: value => {
          const pattern = /^[\\+]?[(]?[0-9]{3}[)]?[-\s\\.]?[0-9]{3}[-\s\\.]?[0-9]{4,6}$/im
          return pattern.test(value) || 'Invalid phone'
        },
        site: value => {
          const pattern = /(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\\+.~#?&//=]*)/g
          return pattern.test(value) || 'Invalid site'
        }
      }
    }
  },
  mounted () {
    this.user = this.$store.getters['account/getAccount']
    this.$store.dispatch('companyDirection/downloadDirections')
  },
  computed: {
    ...mapState({
      directions: (state) => state.companyDirection.directions
    }),
    isCompany () {
      return this.user.roles.find((role) => role === 'company') !== undefined
    }
  },
  methods: {
    changeDirection (item) {
      if (item) {
        const unit = this.directions.find((u) => u.name === item)
        if (!unit) {
          const direction = this.directions.find((i) => i.id === 'new')
          if (direction) {
            direction.name = item
          } else {
            this.directions.push({ id: 'new', name: item })
          }
        }
      }
    },
    updateInformation () {
      console.log('Update')
    }
  }
}
</script>

<style scoped>

</style>
