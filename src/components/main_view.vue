<template>
  <div class="main_view_widnow">
      <div :class="[{'lite_vew_show_anim' : hide_lite},{'lite_vew_hide_anim' : show_lite}]" class="main_view_bar">
          <menu_bar :class="[{'lite_vew_show_anim' : hide_lite},{'lite_vew_hide_anim' : show_lite}]" @lite="lite_ver"/>
      </div>
      <div class="main_view_window">
          <div class="main_view_window_header">
            <user_bar/>
          </div>
          <calendar v-show="active_cal == 2"/>
          <cal_day v-show="active_cal == 1"/>
          <loading v-show="loads_info"/>
      </div>
      <mobile_add_button  v-show="mobile_view"/>
      <cal_mode/>
      <add_event v-show="add_pop" @close='close_add'/>
      <user_profile v-show="pro_pop"/>
      <settings v-show="set_pop"/>
      <schedule v-show="sch_pop"/>
      <cal_set v-show="show_cal_set"/>
      <show_event v-show="show_info_pop" @close='show_info_ev_pop'/>
      <user_manage v-show="show_user_man_pop" @close='show_user_cal_pop'/>
  </div>
</template>

<script>
import calendar from './calendar.vue'
import cal_day from './cal_day.vue'

import menu_bar from './menu_bar.vue'
import user_bar from './user_bar.vue'

import add_event from './windows/add_event.vue'
import show_event from './windows/show_event.vue'
import user_profile from './windows/user_profile.vue'
import settings from './windows/settings.vue'
import schedule from './windows/schedule.vue'
import cal_set from './windows/cal_set.vue'
import user_manage from './windows/user_manage.vue'
import cal_mode from './windows/cal_mode.vue'

import loading from './windows/loading.vue'
import mobile_add_button from './windows/mobie_add_button.vue'
// import alerts_box from './alerts.vue'

import send from '../libs/send.js'
var tata = require("tata-js")

export default {
  name: 'Main_view',
  data: function() {
    return {
      add_pop: false,
      show_info_pop: false,
      show_user_man_pop: false,
      pro_pop: false,
      set_pop: false,
      sch_pop: false,
      hide_lite: false,
      show_lite: false,
      show_cal_set: false,
      block_size: false,
      loads_info: false,
      mobile_view: false,
      active_cal: 2,
      user_info: {}
    }
  },
  components: {
    calendar,
    menu_bar,
    user_bar,
    add_event,
    user_profile,
    settings,
    schedule,
    cal_set,
    loading,
    show_event,
    cal_mode,
    user_manage,
    cal_day,
    mobile_add_button
    // alerts_box
  },
  methods: {
    show_add() {
      this.add_pop = true
    },
    close_add() {
      this.add_pop = false
    },    
    show_pro() {
      if (!this.pro_pop) this.pro_pop = true
      else this.pro_pop = false
      // this.alert_pop(4, 'Test', 'testuje')
    },
    show_set() {
      if (!this.set_pop) this.set_pop = true
      else this.set_pop = false
    },
    show_sch() {
      if (!this.sch_pop) {
        // this.$root.$refs.sche_pop.get_date()
        this.sch_pop = true
      }
      else this.sch_pop = false
    },
    show_cal_pop() {
      if (!this.show_cal_set) this.show_cal_set = true
      else this.show_cal_set = false
    },
    show_info_ev_pop() {
      if (!this.show_info_pop) this.show_info_pop = true
      else this.show_info_pop = false
    },
    show_user_cal_pop() {
      if (!this.show_user_man_pop) this.show_user_man_pop = true
      else this.show_user_man_pop = false
    },
    lite_ver() {
      if (!this.hide_lite){
        this.show_lite = false
        this.hide_lite = true
      }
      else {
        this.hide_lite = false
        this.show_lite = true
      }
    },
    resize_win_app() {
      // console.log('resize', window.innerWidth)
      if (window.innerWidth < 890) {
        this.mobile_view = true
        this.$root.$refs.user_bar.mobile_view = true
        this.$root.$refs.add_event_pop.mobile_view = true
        this.change_cal_mode(1)
      } else {
        this.mobile_view = false
        this.$root.$refs.user_bar.mobile_view = false
        this.$root.$refs.add_event_pop.mobile_view = false
        this.change_cal_mode(2)
      }
      if (window.innerWidth < 1100) {
        if (!this.block_size){
          // this.lite_ver()
          this.$root.$refs.menu_bar.lite_version()
          this.block_size = true  
        }
      } else {
        if (this.block_size) {
          // this.lite_ver()
          this.$root.$refs.menu_bar.lite_version()
          this.block_size = false  
        }
      }
    },
    get_data(mode, dates=new Date()) {
      let vm = this
      this.loads_info = true
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

      function get_more(page=2) {
        if (mode === 1) {
          send.send_get(vm.$root.$refs.app_view.url_path  + "api/events/index.php?mode=2&page="+ page.toString() +"&date=" + dates.toLocaleDateString("en-CA"), function(resp) {
              if (is_json(resp.responseText)) {
                let items = JSON.parse(resp.responseText)
                items.forEach(e => {
                    if (is_empty(e))
                    vm.$root.$refs.calendar_day.add_event(
                      parseInt(e['Time_start'].split(' ')[1].split(':')[0]),
                      parseInt(e['Time_start'].split(' ')[1].split(':')[1]),
                      parseInt(e['Time_end'].split(' ')[1].split(':')[0]),
                      parseInt(e['Time_end'].split(' ')[1].split(':')[1]),
                      e['Title'],
                      new Date(e['Time_start'].split(' ')[0].split('-')[0], parseInt(e['Time_start'].split(' ')[0].split('-')[1]) - 1 , e['Time_start'].split(' ')[0].split('-')[2]),
                      new Date(e['Time_end'].split(' ')[0].split('-')[0], parseInt(e['Time_end'].split(' ')[0].split('-')[1]) - 1, e['Time_end'].split(' ')[0].split('-')[2]),
                      e['ID'],
                      e['Color'],
                      e['Mode']
                    )
                });
                if (items.length >= 25) get_more(page++)
                else vm.loads_info = false
              } else vm.loads_info = false
          }, function() {
            vm.loads_info = false
          })        
        } else if (mode == 2) {
          send.send_get(vm.$root.$refs.app_view.url_path + "api/events/index.php?mode=1&page="+ page.toString() +"&date=" + dates.toLocaleDateString("en-CA"), function(resp) {
              if (is_json(resp.responseText)) {
                let items = JSON.parse(resp.responseText)
                items.forEach(e => {
                    if (is_empty(e))
                    vm.$root.$refs.calendar.add_event(
                      parseInt(e['Time_start'].split(' ')[1].split(':')[0]),
                      parseInt(e['Time_start'].split(' ')[1].split(':')[1]),
                      parseInt(e['Time_end'].split(' ')[1].split(':')[0]),
                      parseInt(e['Time_end'].split(' ')[1].split(':')[1]),
                      e['Title'],
                      new Date(e['Time_start'].split(' ')[0].split('-')[0], parseInt(e['Time_start'].split(' ')[0].split('-')[1]) - 1 , e['Time_start'].split(' ')[0].split('-')[2]),
                      new Date(e['Time_end'].split(' ')[0].split('-')[0], parseInt(e['Time_end'].split(' ')[0].split('-')[1]) - 1, e['Time_end'].split(' ')[0].split('-')[2]),
                      e['ID'],
                      e['Color'],
                      e['Mode']
                    )
                });
                if (items.length >= 25) get_more(page++)
                else vm.loads_info = false
              } else vm.loads_info = false
              
          }, function() {
            vm.loads_info = false
          })        
        }
      }

      if (mode === 1) {
        vm.$root.$refs.calendar_day.to_week(dates)
        send.send_get(this.$root.$refs.app_view.url_path  + "api/events/index.php?mode=2&page=1&date=" + dates.toLocaleDateString("en-CA"), function(resp) {
            if (is_json(resp.responseText)) {
              let items = JSON.parse(resp.responseText)
              items.forEach(e => {
                  if (is_empty(e))
                  vm.$root.$refs.calendar_day.add_event(
                    parseInt(e['Time_start'].split(' ')[1].split(':')[0]),
                    parseInt(e['Time_start'].split(' ')[1].split(':')[1]),
                    parseInt(e['Time_end'].split(' ')[1].split(':')[0]),
                    parseInt(e['Time_end'].split(' ')[1].split(':')[1]),
                    e['Title'],
                    new Date(e['Time_start'].split(' ')[0].split('-')[0], parseInt(e['Time_start'].split(' ')[0].split('-')[1]) - 1 , e['Time_start'].split(' ')[0].split('-')[2]),
                    new Date(e['Time_end'].split(' ')[0].split('-')[0], parseInt(e['Time_end'].split(' ')[0].split('-')[1]) - 1, e['Time_end'].split(' ')[0].split('-')[2]),
                    e['ID'],
                    e['Color'],
                    e['Mode']
                  )
              });
              if (items.length >= 25) get_more()
              else vm.loads_info = false
            }
            // vm.loads_info = false
        }, function() {
          vm.loads_info = false
        })        
        vm.loads_info = false
      } else if (mode == 2) {
        this.$root.$refs.calendar.to_week(dates)
        send.send_get(this.$root.$refs.app_view.url_path + "api/events/index.php?mode=1&page=1&date=" + dates.toLocaleDateString("en-CA"), function(resp) {
            if (is_json(resp.responseText)) {
              let items = JSON.parse(resp.responseText)
              items.forEach(e => {
                  if (is_empty(e))
                  vm.$root.$refs.calendar.add_event(
                    parseInt(e['Time_start'].split(' ')[1].split(':')[0]),
                    parseInt(e['Time_start'].split(' ')[1].split(':')[1]),
                    parseInt(e['Time_end'].split(' ')[1].split(':')[0]),
                    parseInt(e['Time_end'].split(' ')[1].split(':')[1]),
                    e['Title'],
                    new Date(e['Time_start'].split(' ')[0].split('-')[0], parseInt(e['Time_start'].split(' ')[0].split('-')[1]) - 1 , e['Time_start'].split(' ')[0].split('-')[2]),
                    new Date(e['Time_end'].split(' ')[0].split('-')[0], parseInt(e['Time_end'].split(' ')[0].split('-')[1]) - 1, e['Time_end'].split(' ')[0].split('-')[2]),
                    e['ID'],
                    e['Color'],
                    e['Mode']
                  )
              });
              if (items.length >= 25) get_more()
              else vm.loads_info = false
            }
            // vm.loads_info = false
        }, function() {
          vm.loads_info = false
        })        
      }
    },
    change_cal_mode(id) {
      if (this.active_cal != id) {
        this.active_cal = id
        // this.$root.$refs.calendar_pop_bar.reset_cal()
        this.$root.$refs.user_bar.selected_date = new Date()
        this.$root.$refs.user_bar.$refs.calnedar_com_1.reset_cal(true)
        // this.$root.$refs.user_bar.$refs.calnedar_com_1.
        this.get_data(this.active_cal)
        
      }
    },
    refresh_cal() {
      this.get_data(this.active_cal, this.$root.$refs.user_bar.selected_date)
      if (this.sch_pop) {
        this.$root.$refs.sche_pop.clear_sch()
        this.$root.$refs.sche_pop.get_date()
        setTimeout(this.$root.$refs.sche_pop.setup_points(), 5000)
      }
    },
    add_event_to_cal() {
      this.get_data(this.active_cal, this.$root.$refs.user_bar.selected_date)
    },
    alert_pop(type, head, text, args={duration: 5000, closeBtn:false}) {

      switch(type) {
        case 1:
          tata.text(head, text, args)
          break
        case 2:
          tata.log(head, text, args)
          break
        case 3:
          tata.info(head, text, args)
          break
        case 4:
          tata.success(head, text, args)
          break
        case 5:
          tata.warning(head, text, args)
          break
        case 6:
          tata.error(head, text, args)
          break
      } 
    }
  },
  created() {
    window.addEventListener('resize', this.resize_win_app)
  },
  destroyed() {
    window.removeEventListener('resize', this.resize_win_app)    
  },
  mounted() {
    this.$root.$refs.main = this
    this.resize_win_app()
    // console.log(this.$root.$refs.app_view.user_info)
    this.$root.$refs.menu_bar.user_name_login = this.$root.$refs.app_view.user_info["U_name"]
    this.$root.$refs.menu_bar.image_prof_path = (this.$root.$refs.app_view.url_path.slice(-1) == '/' ? this.$root.$refs.app_view.url_path.slice(0, -1) :  this.$root.$refs.app_view.url_path ) + this.$root.$refs.app_view.user_info["U_profile"]
    this.$root.$refs.menu_bar.menage = parseInt(this.$root.$refs.app_view.user_info["U_rank"]) > 1 ? true : false  
    this.$root.$refs.user_pop.user_name_login = this.$root.$refs.app_view.user_info["U_name"]
    this.$root.$refs.user_pop.user_mail_login = this.$root.$refs.app_view.user_info["U_mail"]
    this.$root.$refs.user_pop.user_prof_path = (this.$root.$refs.app_view.url_path.slice(-1) == '/' ? this.$root.$refs.app_view.url_path.slice(0, -1) :  this.$root.$refs.app_view.url_path ) + this.$root.$refs.app_view.user_info["U_profile"]
    
    this.get_data(2)
  }
}
</script>

<style scoped>

    .main_view_widnow {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: row;
        justify-items: center;
    }

    .main_view_bar {
        width: 270px;
        height: 100%;
        /* border: 1px solid red; */
    }

    .main_view_window {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .main_view_window_header {
        position: relative;
        width: 100%;
        height: 65px;
        /* border: 1px solid green; */
    }

    .lite_vew_show_anim {
        animation-name: lite_vew_show;
        animation-duration: 1s;
        animation-iteration-count: 1;
        animation-direction: normal;
        animation-fill-mode: forwards;
    }

    @keyframes lite_vew_show {
        from {
            width: 270px;
        }
        to {
            width: 70px;
        }
    }

    .lite_vew_hide_anim {
        animation-name: lite_vew_hide;
        animation-duration: 1s;
        animation-iteration-count: 1;
        animation-direction: normal;
        animation-fill-mode: forwards;
    }

    @keyframes lite_vew_hide {
        from {
            width: 70px;
        }
        to {
            width: 270px;
        }
    }

</style>
