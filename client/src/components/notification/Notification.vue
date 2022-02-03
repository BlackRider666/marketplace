<template>
  <div class="text-center">
    <v-snackbar multi-line right bottom :timeout="timeout" v-model="show" :color="color">
      <template v-if="messageTKey">
        <div>{{$t(messageTKey)}}</div>
      </template>
      <template v-if="message">
        <div>{{ message }}</div>
      </template>
      <v-btn dark text @click="show = false">{{ $t('btn.close', 'Close') }}</v-btn>
    </v-snackbar>
  </div>
</template>

<script>
export default {
  name: 'Notification',
  data: () => ({
    show: false,
    message: '',
    messageTKey: '',
    color: '',
    options: {}
  }),
  computed: {
    timeout: function () {
      return 'timeout' in this.options ? this.options.timeout : 10000
    }
  },
  created () {
    this.$store.subscribe((mutation, state) => {
      if (mutation.type === 'notifier/SHOW_MESSAGE') {
        this.message = state.notifier.content
        this.messageTKey = state.notifier.contentTKey
        this.color = state.notifier.color
        this.options = state.notifier.options
        this.show = true
      }
    })
  }
}
</script>

<style scoped>

</style>
