<template>
  <div id="app">
    <login @login_suc="login_succes" v-if="login_page"/>
    <Main_view v-else/>
  </div>
</template>

<script>
import login from './components/login.vue'
import Main_view from './components/main_view.vue'
import send from './libs/send.js'

// import VueWaypoint from "vue-waypoint"
// import Vue from 'vue'
// Vue.use(VueWaypoint)
export default {
  name: 'App',
  data: function() {
    return {
      login_page: true,
      user_info: [],
      url_path: window.location.origin + window.location.pathname // 'http://localhost:8090/back/' 
    }
  },
  methods: {
    login_succes() {
      this.get_user_data_info()
    },
    get_user_data_info() {
      function is_json(data) {
        try {
          JSON.parse(data)
          return true
        } catch (e) {
          return false
        }
      }
      function is_empty(row) {
        for(let item in row) {
          if (row[item] == null || row[item] == undefined) return false
        }
        return true
      }
      let vm = this
      vm.$root.$refs.login_page_view.login_loading = true
      if (window.localStorage.getItem("SID") == undefined) {
        send.send_get(this.url_path + 'api/get_user_info.php', function(resp) {
          if (is_json(resp.responseText) && is_empty(JSON.parse(resp.responseText))) {
            vm.$root.$refs.login_page_view.login_loading = false
            if (vm.login_page) {
              vm.login_page = false
            }
            vm.user_info = JSON.parse(resp.responseText)
            window.localStorage.setItem("SID", JSON.parse(resp.responseText)['Ses_id'])
          } else {
            vm.$root.$refs.login_page_view.login_loading = false
          }
        }, function() {
          vm.$root.$refs.login_page_view.login_loading = false
        })
      } else {
        send.send_get(this.url_path + 'api/get_user_info.php?ID=' + window.localStorage.getItem("SID"), function(resp) {
          if (is_json(resp.responseText) && is_empty(JSON.parse(resp.responseText))) {
            vm.$root.$refs.login_page_view.login_loading = false
            if (vm.login_page) {
              vm.login_page = false
            }
            vm.user_info = JSON.parse(resp.responseText)
          } else {
            vm.$root.$refs.login_page_view.login_loading = false
          }
        }, function() {
          vm.$root.$refs.login_page_view.login_loading = false
        })
      }

    }
  },
  components: {
    login,
    Main_view,
  },
  mounted: function() {
    this.$root.$refs.app_view = this
    if (window.localStorage.getItem("APath") != undefined) {
      this.url_path = window.localStorage.getItem("APath")
    }
    this.get_user_data_info()
  },created: function() {
    
  }
}
</script>

<style>

body, html {
  width: 100%;
  height: 100%;
  margin: 0;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  width: 100%;
  height: 100%;
  margin: 0;
}
</style>
