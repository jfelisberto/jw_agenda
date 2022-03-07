import Vue from 'vue'
import axios from 'axios'

//axios.defaults.baseURL = 'http://jefweb.net/jefweb/jw_agenda/public'
axios.defaults.baseURL = 'http://192.168.0.111/jefweb/jw_agenda/public'

Vue.use({
    install(Vue){
        Vue.prototype.$http = axios;
    }
})

export default axios
