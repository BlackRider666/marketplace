<template>
  <v-card>
    <v-card-title><span>Компьютер ASUS</span><v-spacer/><span class="product__price">40.00$</span></v-card-title>
    <v-card-text>
      <v-row dense>
        <v-col cols="6">
          <v-row dense>
            <v-col cols="2">
              <v-list-item-group v-model="slideIndex">
                <v-list-item
                  v-for="(slide,key) in slides"
                  :key="key"
                  active-class="slider__btn__active"
                ><v-img :src="slide.url"  max-height="100%" max-width="100%"/>
                </v-list-item>
              </v-list-item-group>
            </v-col>
            <v-col cols="10">
              <v-carousel
                v-model="slideIndex"
                hide-delimiters
                :show-arrows="false"
                vertical
              >
                <v-carousel-item
                  v-for="(slide,key) in slides"
                  :key="key"
                ><v-img :src="slide.url"  max-height="100%" max-width="100%"/>
                </v-carousel-item>
              </v-carousel>
            </v-col>
          </v-row>
        </v-col>
        <v-col cols="6"></v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: 'Features',
  data () {
    return {
      slides: [
        {
          url: 'https://picsum.photos/id/237/400'
        },
        {
          url: 'https://picsum.photos/id/238/400'
        },
        {
          url: 'https://picsum.photos/id/239/400'
        },
        {
          url: 'https://picsum.photos/id/236/400'
        },
        {
          url: 'https://picsum.photos/id/235/400'
        },
        {
          url: 'https://picsum.photos/id/234/400'
        },
        {
          url: 'https://picsum.photos/id/233/400'
        }
      ],
      slideIndex: 0
    }
  }
}
</script>

<style lang="scss">
.product {
  &__price {
    color: #FF5252;
    border: 2px solid #FF5252;
    border-radius: 15px;
    padding: 5px 15px;
    font-weight: bold;
  }
}
.slider__btn__active {
  padding: 0;
}
</style>
