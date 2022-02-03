<template>
  <v-menu
      :open-on-hover="options.openOnHover"
      :close-on-click="options.closeOnClick"
      :close-on-content-click="options.closeOnContentClick"
      :offset-x="options.offsetX"
      :offset-y="options.offsetY"
      left
      :nudge-bottom="options.nudgeBottom"
  >
    <template v-slot:activator="{ on }">
      <div :data-v-step="dataStep" class="title font-weight-bold px-1" :class="options.iconsType" v-on="on">
        <v-badge
            :content="options.badgeContent"
            :color="options.badgeColor"
            :value="options.badgeContent"
            overlap
        >
          <flag style="max-width: 16px;" v-if="options.titleFlag" :iso="options.titleFlag" class="mr-2" />
          <span v-if="options.title" v-html="options.title"></span>
          <span v-if="options.titleTKey" :class="options.titleClass">{{ $t(options.titleTKey,options.titleTDefault) }}</span>
          <img v-if="options.titleImage" :class="options.titleClass" :src="options.titleImage"/>
          <template v-if="options.titleIcon">
            <feather-icon v-if="options.iconsType && options.iconsType === 'feather'" :icon="options.titleIcon"/>
            <v-icon v-else>{{options.titleIcon}}</v-icon>
          </template>
        </v-badge>
        <v-icon v-if="options.showArrow">mdi-chevron-down</v-icon>
      </div>
    </template>
    <v-list avatar class="py-0">
      <template v-if="options.subheader || options.subheaderTKey">
        <v-card
            color="primary"
            dark
            tile
            :elevation="0"
        >
          <v-card-title>
            <div v-if="options.subheader" v-html="options.subheader"></div>
            <div v-if="options.subheaderTKey">{{ $t(options.subheaderTKey,options.subheaderTDefault) }}</div>
          </v-card-title>
        </v-card>
      </template>
      <v-list-item-group class="px-2 py-1">
        <div v-for="(item, index) in options.items"
             :key="index">
          <v-list-item
              class="my-1"
              :to="item.to"
          >
            <v-list-item-avatar size="26" v-if="item.image || item.icon">
              <v-img v-if="item.image" :src="item.image"></v-img>
              <v-icon v-if="item.icon">{{item.icon}}</v-icon>
            </v-list-item-avatar>
            <flag v-if="item.flag" :iso="item.flag" class="mr-2" />
            <v-list-item-content>
              <v-list-item-subtitle :class="item.subtitleClass" v-if="item.title" v-html="item.title"></v-list-item-subtitle>
              <v-list-item-subtitle :class="item.subtitleClass" v-if="item.titleTKey">{{$t(item.titleTKey,item.titleTDefault)}}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <div :class="{'list-divider': item.divider}"></div>
        </div>
      </v-list-item-group>
    </v-list>
  </v-menu>
</template>

<script>
export default {
  name: 'MenuList',
  props: {
    dataStep: {
      default: '',
      type: String
    },
    options: {
      items: {
        default: () => {},
        type: Array
      },
      offsetY: {
        default: true,
        type: Boolean
      },
      nudgeBottom: {
        default: 30,
        type: Number
      },
      offsetX: {
        default: false,
        type: Boolean
      },
      openOnHover: {
        default: false,
        type: Boolean
      },
      closeOnClick: {
        default: false,
        type: Boolean
      },
      closeOnContentClick: {
        default: false,
        type: Boolean
      },
      subheader: {
        default: null
      },
      subheaderTKey: {
        default: null
      },
      showArrow: {
        default: false,
        type: Boolean
      },
      titleIcon: {
        default: null,
        type: String
      },
      title: {
        default: null,
        type: String
      },
      titleClass: {
        default: '',
        type: String
      },
      titleTKey: {
        default: null,
        type: String
      },
      titleFlag: {
        default: null,
        type: String
      },
      titleImage: {
        default: null
      },
      badgeContent: {
        default: null
      },
      badgeColor: {
        default: 'primary'
      },
      href: {
        default: ''
      }
    }
  }
}
</script>

<style scoped>

</style>
