<script>
export default {
  name: 'Logout',
  mounted () {
    this.logout()
  },
  methods: {
    logout () {
      this.$store.dispatch('auth/logout').then(() => {
        this.$router.push({ name: 'login' })
      })
    }
  }
}
</script>
