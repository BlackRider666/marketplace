<template>
  <v-card>
    <v-card-title>
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
    </v-card-title>
    <v-card-text class="px-0">
      <v-row dense>
        <v-col cols="4" class="text-center">
          <v-img :src="user.avatar" width="140pt" height="140pt" class="rounded-circle mx-auto mb-2"/>
          <p class="account__name">{{user.full_name}}</p>
          <p class="account__field">Ivan Ivanov</p>
          <p class="account__field">Ivan Ivanov</p>
          <p class="account__field">Ivan Ivanov</p>
          <p class="account__field">Ivan Ivanov</p>
        </v-col>
        <v-col cols="8">
          <v-tabs centered>
            <v-tab>
              Мои покупки
            </v-tab>
            <v-tab>
              Мои продажи
            </v-tab>
            <v-tab-item>
              <v-data-table
                class="mt-5"
                :headers="salesHeader"
                :items="sales"
                :options.sync="options"
                :server-items-length="total"
                :footer-props="{
                  itemsPerPageOptions:[5,10,15,20]
              }"
                dense
              ></v-data-table>
              <v-row dense>
                <v-col cols="12">
                  <v-card outlined>
                    <v-card-title>Период   01.01.2020   по 01.02.2021</v-card-title>
                    <v-card-text>
                      <v-sparkline
                        :gradient="['#f44336']"
                        line-width="2px"
                        smooth
                        :value="value"
                        auto-draw
                        height="150"
                      >
                        <template v-slot:label="item">
                          ${{ item.value }}
                        </template>
                      </v-sparkline>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
            </v-tab-item>
            <v-tab-item>
              <v-data-table
                class="mt-5"
                :headers="salesHeader"
                :items="sales"
                :options.sync="options"
                :server-items-length="total"
                :footer-props="{
                  itemsPerPageOptions:[5,10,15,20]
              }"
                dense
              ></v-data-table>
              <v-row dense>
                <v-col cols="12">
                  <v-card outlined>
                    <v-card-title>Период   01.01.2020   по 01.02.2021</v-card-title>
                    <v-card-text>
                      <v-sparkline
                        :gradient="['#f44336']"
                        line-width="2px"
                        smooth
                        :value="value"
                        auto-draw
                        height="150"
                      >
                        <template v-slot:label="item">
                          ${{ item.value }}
                        </template>
                      </v-sparkline>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
            </v-tab-item>
          </v-tabs>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'Statistics',
  data () {
    return {
      salesHeader: [
        { text: this.$t('works.placeholder.title', 'Название'), value: 'title' },
        { text: this.$t('works.placeholder.start', 'Дата заказа'), value: 'start' },
        { text: this.$t('works.placeholder.finish', 'Дата отправки'), value: 'finish' },
        { text: this.$t('works.placeholder.finish', 'Сума заказа'), value: 'sum' },
        { text: this.$t('works.placeholder.finish', 'Экономия'), value: 'economy' },
        { text: 'Статус', value: 'status', sortable: false }
      ],
      options: {},
      sales: [],
      total: 0,
      value: [0, 8, 10, 7, 17]
    }
  },
  computed: {
    ...mapState({
      user: (state) => state.account.user
    })
  }
}
</script>

<style lang="scss">
.account {
  &__name {
    font-size: 24px;
    font-weight: bold;
  }
  &__field {
    font-size: 18px;
    font-weight: bold;
  }
}
</style>
