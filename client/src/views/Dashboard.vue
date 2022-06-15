<template>
    <v-row>
      <v-container>
      <v-btn text v-if="!filterSheet" class="mt-3" @click="filterSheet = true">
        Filters
        <v-icon>mdi-tune</v-icon>
      </v-btn>
      <v-sheet v-if="filterSheet" dense flat>
        <v-row>
          <v-col cols="1" align-self="center" justify="center">
            <v-btn text @click="filterSheet = false">
              <v-icon>mdi-chevron-up</v-icon>
            </v-btn>
          </v-col>
          <v-col cols="11">
            <v-radio-group
              v-model="type"
              row
            >
              <v-spacer/>
              <v-radio
                label="Оптовая"
                value="opt"
                class="category__type__title"
              ></v-radio>
              <v-spacer/>
              <v-radio
                label="Розница"
                value="rozn"
                class="category__type__title"
              ></v-radio>
              <v-spacer/>
            </v-radio-group>
          </v-col>
          <v-col cols="4" v-for="(category,key) in categories" :key="key" class="text-center">
            <v-btn text class="category__title">{{category.title}}</v-btn>
          </v-col>
        </v-row>
      </v-sheet>
      </v-container>
      <v-container fluid>
      <v-row dense>
        <v-col cols="2" v-for="(product,key) in products" :key="key">
          <v-card>
            <v-card-text><v-img :src="product.img_url" max-width="100%" max-height="100%"/></v-card-text>
            <v-card-title class="product__title py-0"><span>{{ product.title }}</span></v-card-title>
            <v-card-actions>
              <v-btn text disabled><v-icon>mdi-arrow-left</v-icon></v-btn>
              <v-spacer/>
              <span class="text-center">
                <strong class="product__price">{{ product.price }}</strong>
                <br>
                <span>{{product.date}}</span>
              </span>
              <v-spacer/>
              <v-btn text color="success"><v-icon>mdi-arrow-right</v-icon></v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
      </v-container>
    </v-row>
</template>

<script>

export default {
  name: 'Dashboard',
  data () {
    return {
      products: [
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        },
        {
          title: 'Kasa Smart Plug Power Strip HS300, Surge Protector…',
          img_url: 'http://localhost/img/company.png',
          price: '50$',
          date: 'now'
        }
      ],
      type: 'opt',
      categories: [
        {
          title: 'Бытовая електроника'
        },
        {
          title: 'Здоровье'
        },
        {
          title: 'Дом и кухня'
        },
        {
          title: 'Бытовая електроника'
        },
        {
          title: 'Здоровье'
        },
        {
          title: 'Дом и кухня'
        },
        {
          title: 'Бытовая електроника'
        },
        {
          title: 'Здоровье'
        },
        {
          title: 'Дом и кухня'
        },
        {
          title: 'Бытовая електроника'
        },
        {
          title: 'Здоровье'
        },
        {
          title: 'Дом и кухня'
        }
      ],
      filterSheet: false
    }
  }
}
</script>

<style lang="scss">
.product {
  &__title {
    font-size: 14px;
    text-align: center;
  }
  &__price {
    font-size:18px;
  }
}
.category {
  &__type {
    &__title .v-label {
      font-size: 18px;
    }
  }
  &__title .v-btn__content{
    font-size: 14px;
    text-transform: none;
  }
}
</style>
