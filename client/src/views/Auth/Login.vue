<template>
  <v-col cols="12" md="5" sm="8">
    <v-card
        class="mx-auto"
        raised
        outlined
    >
      <v-card-title class="d-flex align-center justify-center">
        <router-link class="d-flex align-center auth__logo py-5" :to="{name: 'dashboard'}">
          <h2 class="text-2xl font-weight-semibold">{{$t('main.company-name','LongPay')}}</h2>
        </router-link>
      </v-card-title>
      <v-card-text>
            <v-row justify="center">
              <v-col cols="6" align="center">
                <div class="headline">{{$t('login.welcome', 'Welcome')}}</div>
              </v-col>
            </v-row>
            <v-form
                ref="form"
                lazy-validation
                align="center"
                @submit="login"
            >
              <v-text-field
                  v-model="user.email"
                  outlined
                  prepend-inner-icon="mdi-email-outline"
                  :label="$t('placeholder.email', 'Email')"
                  :rules="[rules.required, rules.email]"
                  type="email"
              />

              <v-text-field
                  v-model="user.password"
                  :rules="[rules.required]"
                  outlined
                  prepend-inner-icon="mdi-lock"
                  color="primary"
                  :type="passwordType"
                  :label="$t('placeholder.password', 'Password')"
              >
                <template v-slot:append>
                  <v-icon color="secondary" v-if="passwordType === 'password'" @click="passwordType = 'text'">mdi-eye</v-icon>
                  <v-icon color="primary" v-if="passwordType === 'text'" @click="passwordType = 'password'">mdi-eye</v-icon>
                </template>
              </v-text-field>

              <div class="d-flex justify-space-between">
                <v-btn @click="$router.push({name: 'register'})" class="mt-3" color="primary" outlined>
                  {{$t('btn.register', 'Register')}}
                </v-btn>
                <v-btn type="submit" class="mt-3" color="primary">
                  {{$t('btn.login', 'Login')}}
                </v-btn>
              </div>
            </v-form>
      </v-card-text>
    </v-card>
  </v-col>
</template>

<script>
export default {
  name: 'Login',
  data: function () {
    return {
      user: {
        email: '',
        password: ''
      },
      passwordType: 'password',
      rules: {
        required: value => !!value || 'Required.',
        email: value => {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(value) || 'Invalid e-mail.'
        }
      }
    }
  },
  methods: {
    login (e) {
      e.preventDefault()
      e.stopPropagation()
      if (!this.$refs.form.validate()) return
      this.$loading()
      this.$store.dispatch('auth/login', this.user)
        .then(() => {
          this.$loadingClose()
          this.$store.dispatch('account/downloadAccount')
          this.$router.push({ name: 'dashboard' })
        })
        .catch(error => {
          this.$loadingClose()
          this.$notify('', 'error', error.response.data.message)
        })
    }
  }
}
</script>

<style scoped>

</style>
