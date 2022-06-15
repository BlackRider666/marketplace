<template>
  <v-row>
    <v-toolbar flat dense>
      <v-spacer/>
      <v-btn
        text
      >
        <v-icon>
          mdi-download
        </v-icon>
      </v-btn>
      <v-btn
        text
      >
        <v-icon>
          mdi-printer-outline
        </v-icon>
      </v-btn>
    </v-toolbar>
    <v-container>
      <v-row>
        <v-tabs grow>
          <v-tab>
            Характеристики
          </v-tab>
          <v-tab>
            Отзывы
          </v-tab>
          <v-tab>
            Предложения
          </v-tab>
          <v-tab>
            Вопросы
          </v-tab>
          <v-tab-item>
            <Features/>
          </v-tab-item>
          <v-tab-item>
            <Reviews/>
          </v-tab-item>
          <v-tab-item>
            <Suggestions/>
          </v-tab-item>
          <v-tab-item>
            <Questions/>
          </v-tab-item>
        </v-tabs>
      </v-row>
    </v-container>
  </v-row>
</template>

<script>
import Features from './Features'
import Reviews from './Reviews'
import Suggestions from './Suggestions'
import Questions from './Questions'

export default {
  name: 'Product',
  components: {
    Features,
    Reviews,
    Suggestions,
    Questions
  }
}
</script>

<style scoped>

</style>
