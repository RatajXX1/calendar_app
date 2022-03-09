<template>
  <div style="overflow: hidden"  class="login_back">
    <div class="login_alert_back"> 
      <div class="login_alert" v-bind:class="[{'login_back_anim_show' : alerts_show} , {'login_back_anim_hide' : alerts_hide} ]">
        <a>{{Err_mess}}</a>
      </div>
    </div>
    <div v-show="login_loading" style="display: block; z-index: 20;" class="loading_pop">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
            <circle cx="50" cy="50" r="34" stroke-width="4" stroke="#2d2d2d" stroke-dasharray="53.40707511102649 53.40707511102649" fill="none" stroke-linecap="round">
                <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>
            </circle>
        </svg>
        <a>Ładowanie</a>
    </div>
    <div v-show="path_to_server" style="display: block; z-index: 20;" class="for_pass">
      <button v-on:click="close_path" class="return_back">
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
        <g data-name="Layer 2" id="Layer_2">
            <path d="M13,26a1,1,0,0,1-.71-.29l-9-9a1,1,0,0,1,0-1.42l9-9a1,1,0,1,1,1.42,1.42L5.41,16l8.3,8.29a1,1,0,0,1,0,1.42A1,1,0,0,1,13,26Z"/>
            <path d="M28,17H4a1,1,0,0,1,0-2H28a1,1,0,0,1,0,2Z"/>
        </g>
        </svg>
      </button>
      <h1>Adres serwera</h1>
      <!-- <a id="pop_head">Jeżeli istnieje konto z podanym adresem email to na podany adres przyjdzie wiadomosc email</a> -->
      <div class="login_pop_input">
        <a>Adres serwera</a>
        <div class="login_pop_input_type">
          <input ref="path_to_server_intput" type="text">
        </div>
      </div>
      <div class="login_back_foot"> 
        <button v-on:click="save_path">Zapisz</button>
      </div>
    </div>
    <div v-bind:class="[{'forgot_pass_show_c' : pass_for_show}, {'forgot_pass_hide_c' : pass_for_hide}]"  class="for_pass">
      <button v-on:click="back_bt" class="return_back">
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
        <g data-name="Layer 2" id="Layer_2">
            <path d="M13,26a1,1,0,0,1-.71-.29l-9-9a1,1,0,0,1,0-1.42l9-9a1,1,0,1,1,1.42,1.42L5.41,16l8.3,8.29a1,1,0,0,1,0,1.42A1,1,0,0,1,13,26Z"/>
            <path d="M28,17H4a1,1,0,0,1,0-2H28a1,1,0,0,1,0,2Z"/>
        </g>
        </svg>
      </button>
      <h1 style="margin-top: 15px; margin-bottom: 13px">Przypomnij hasło</h1>
      <a id="pop_head">Jeżeli istnieje konto z podanym adresem email to na podany adres przyjdzie wiadomosc email</a>
      <div class="login_pop_input">
        <a>Login</a>
        <div class="login_pop_input_type">
          <input ref="login_rpass"  type="text">
        </div>
      </div>
      <div class="login_pop_input">
        <a>Email</a>
        <div class="login_pop_input_type">
          <input ref="email_rpass"  type="text">
        </div>
      </div>
      <div class="login_back_foot"> 
        <button v-on:click="submit_forgot">Zresetuj hasło</button>
      </div>
    </div>
    <div class="login_pop">
      <h1>Zaloguj się</h1>
      <div class="login_pop_input">
        <a>Login</a>
        <div class="login_pop_input_type">
          <input ref="login_input" type="text">
        </div>
      </div>
      <div class="login_pop_input">
        <a>Hasło</a>
        <div class="login_pop_input_type">
          <input ref="password_input" type="password">
        </div>
        <a v-on:click="forgot_pass" id="pass_re">Przypomnij hasło</a>
      </div>
      <div class="login_back_foot"> 
        <button v-on:click="login">Zaloguj</button>
      </div>
      <!-- <button @click="close_path" class="button_gear">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
          <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
        </svg>
      </button> -->
    </div>
  </div>
</template>

<script>
import send from '../libs/send.js'



export default {
  name: 'Login',
  data: function () {
    return {
      Err_mess: "Niepopranwy login lub hasło!",
      alerts_show: false,
      alerts_hide: false,
      pass_for_show: false,
      pass_for_hide: false,
      path_to_server: false,
      login_loading: false,
    }
  },
  methods: {
    reset_alert: function() {
      if (this.alerts_show) this.alerts_hide = true
      this.alerts_show = false
    },
    forgot_pass: function() {
      this.reset_alert()
      this.pass_for_show = true
      this.pass_for_hide = false
    },
    back_bt: function() {
      if (this.pass_for_show) {
        this.reset_alert()
        this.pass_for_show = false
        this.pass_for_hide = true
      }
    },
    close_path() {
      if (this.path_to_server) this.path_to_server = false
      else this.path_to_server = true
    },
    save_path() {
      let vm = this
      this.$nextTick(() => { 
        vm.$root.$refs.app_view.url_path = vm.$refs.path_to_server_intput.value 
        window.localStorage.setItem("APath", vm.$refs.path_to_server_intput.value)
        vm.close_path()
      })
    },
    submit_forgot() {
      let vm = this
      if (this.$refs.login_rpass.value.replaceAll(' ', '') == '' || this.$refs.email_rpass.value.replaceAll(' ', '') == '') {
        return
      }
      send.send_get( vm.$root.$refs.app_view.url_path  + 'api/Users/forgot_pass.php?login=' + this.$refs.login_rpass.replaceAll(' ', '') + '&email=' + this.$refs.email_rpass.replaceAll(' ', '')
      ,function(resp) {
        if (resp.responseText == "OK") {
          vm.$refs.login_rpass.value = ''
          vm.$refs.email_rpass.value = ''
          vm.back_bt()
        } else {
          vm.$refs.login_rpass.value = ''
          vm.$refs.email_rpass.value = ''
          vm.back_bt()
        }
      }, function() {
        vm.$refs.login_rpass.value = ''
        vm.$refs.email_rpass.value = ''
        vm.back_bt()
      })
    },
    login() {
      function aler_login(vm) {
          // this.Err_mess = mess
        if (!vm.alerts_show && !vm.alerts_hide) {
          vm.alerts_show = true
        } else {
          if (vm.alerts_show && !vm.alerts_hide) {
            vm.alerts_show = false
            vm.alerts_hide = true
          } else {
            vm.alerts_show = true
            vm.alerts_hide = false
          }
        }
      }
      let vm = this
      if (this.alerts_show) aler_login(vm)
      let itme = {'login': "", 'password': ""}
      this.$nextTick( () => { 

          itme["login"] = vm.$refs.login_input.value
          itme["password"] = vm.$refs.password_input.value
          // console.log(vm.$refs.login_input.value, vm.$refs.password_input.value)
          // console.log(itme)
          send.send_post_json(JSON.stringify(itme), 
          vm.$root.$refs.app_view.url_path  + 'api/login.php',
          function(resp) {
            if (resp.responseText == 'OK') {
              aler_login(vm)
              vm.Err_mess = 'zalogowano'
              vm.$emit("login_suc")
            } else {
              
              aler_login(vm)
              vm.Err_mess = resp.responseText
            }
          }, 
          function() {
            aler_login(vm)
            vm.Err_mess = 'Wystąpił błąd! Spróbuj ponownie'
          }
          )
        }
      )
    }
  },mounted: function() {
    let vm = this
    this.$root.$refs.login_page_view = this
    this.$nextTick(() => {
      vm.$refs.path_to_server_intput.value = vm.$root.$refs.app_view.url_path 
    })
    
  },
  created: function() {
    try {
        document.querySelector('.darkmode-background').remove()
        document.querySelector('.darkmode-layer').remove()
        document.querySelector('.darkmode-toggle--inactive').remove()
    } catch (e) {return}
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

  .login_back {
    position: relative;
    width: 100%;
    height: 100%;
    background-color: #ececec;
  }

  .login_alert {
    position: absolute;
    width: 400px;
    height: 70px;
    left: 50%;
    top: 0px;
    transform: translate(-50%, 0);
    background-color: rgb(215, 43, 43);
    border-radius: 5px;
    color: white;
    z-index: 1;
  }

  .login_alert a {
    position: relative;
    display: block;
    width: 90%;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
  }

  .login_alert_back {
    z-index: 2;
    position: absolute;
    width: 400px;
    height: 350px;
    background-color: transparent;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    border-radius: 5px;
  } 

  .for_pass {
    display: none;
    z-index: 2;
    position: absolute;
    width: 400px;
    height: 350px;
    background-color: #ffffff;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: column;
    justify-items: center;
    border-radius: 5px;
  }

  .loading_pop {
    display: none;
    z-index: 2;
    position: absolute;
    width: 400px;
    height: 350px;
    background-color: #ffffff;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: column;
    justify-items: center;
    border-radius: 5px;
  }

  .loading_pop svg {
    position: relative;
    width: 170px;
    height: 170px;
    /* left: 50%; */
    top: 26%;
    /* transform: translate(-50%, -50%); */
  }

  .loading_pop a {
    position: absolute;
    text-align: center;
    width: 100%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .return_back {
    position: absolute;
    background-color: transparent;
    border: none;
    top: 10px;
  }

  .for_pass svg {
    position: relative;
    width: 40px;
    height: auto;
    cursor: pointer;
    /* fill: rgb(45, 45, 45); */
  }

  .login_pop {
    z-index: 3;
    position: relative;
    width: 400px;
    height: 350px;
    background-color: #ffffff;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: column;
    justify-items: center;
    border-radius: 5px;
  }

  #pop_head {
    position: relative;
    text-align: justify;
    text-justify: inter-word;
    width: 75%;
    margin-bottom: 10px;
    display: block;
    left: 50%;
    transform: translate(-50%, 0);
  }

  .for_pass h1,
  .login_pop h1  {
    display: block;
    widows: 100%;
    height: 30px;
    text-align: center;
    margin-top: 30px;
    margin-bottom: 30px;
  }

  .login_pop_input {
    position: relative;
    width: 65%;
    height: 50px;
    margin-bottom: 20px;
    left: 50%;
    transform: translate(-50%, 0);
  }

  .login_pop_input_type {
    position: relative;
    width: 100%;
    height: 32px;
    border: 1px solid #d0d0d0;
    left: 50%;
    transform: translate(-50%, 0);
  }

  .login_pop_input input {
    position: relative;
    width: 95%;
    height: 95%;
    left: 50%;
    top: 50%;
    background-color: transparent;
    border: none;
    outline: none;
    padding: none;
    transform: translate(-50%, -50%);
  }

  .login_back_foot {
    position: absolute;
    width: 100%;
    height: 45px;
    bottom: 20px;
  }

  #pass_re {
    margin-top: 10px;
    float: right;
    cursor: pointer;
  }

  .login_back_foot button {
    position: relative;
    width: 50%;
    border: none;
    height: 40px;
    background-color: rgb(45, 45, 45);
    color: white;
    left: 50%;
    transform: translate(-50%, 0);
    border-radius: 15px;
    cursor: pointer;
    font-size: 17px;
  }

  .login_back_anim_show {
    animation-name: log_alert_show;
    animation-duration: 1s;
    animation-iteration-count: 1;
    animation-direction: normal;
    animation-fill-mode: forwards;
  }

  .button_gear {
    width: fit-content;
    height: fit-content;
    position: absolute;
    display: block;
    background-color: transparent;
    background: none;
    border: none;
    outline: none;
    cursor: pointer;
    right: 10px;
    bottom: 10px;
  }

  @keyframes log_alert_show {
    from {
      top: 0px;
    }
    to {
      top: -100px;
    }
  }

  .login_back_anim_hide {
    animation-name: log_alert_hide;
    animation-duration: 1s;
    animation-iteration-count: 1;
    animation-direction: normal;
    animation-fill-mode: forwards;
  }

  @keyframes log_alert_hide {
    from {
      top: -100px;
    }
    to {
      top: 0px;
    }
  }

  .forgot_pass_show_c {
    animation-name: forgot_pass_show;
    animation-duration: 2s;
    animation-iteration-count: 1;
    animation-direction: normal;
    animation-fill-mode: forwards;
  }

  @keyframes forgot_pass_show {
    0% {
        display: none;
        opacity: 0;
    }

    1% {
        z-index: 4;
        display: block;
        opacity: 0;
    }

    100% {
        display: block;
        opacity: 1;
        z-index: 4;
    }
  }

  .forgot_pass_hide_c {
    animation-name: forgot_pass_hide;
    animation-duration: 2s;
    animation-iteration-count: 1;
    animation-direction: normal;
    animation-fill-mode: forwards;
  }

  @keyframes forgot_pass_hide {
    0% {
        display: block;
        opacity: 1;
        z-index: 4;
    }

    100% {
        opacity: 0;
        z-index: 2;
        display: none;
    }
  }


  @media (max-width: 480px) {
    .for_pass {
      width: 100%;
    }

    .login_pop {
      width: 100%;
    }
    
    .login_alert_back {
      width: 100%;
    }
    .login_alert {
      width: 90%;
    }

    .loading_pop {
      width: 100%;
    }

  }

</style>
