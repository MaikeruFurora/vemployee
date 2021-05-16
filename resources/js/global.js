import vfooter from './components/admin/layout/footer'
import vheader from './components/admin/layout/header'
import vsidebar from './components/admin/layout/sidebar'
export default {
    
    mounted() {
        window.axios.defaults.headers.common['Authorization']=`Bearer ${this.token}`
    },
    components:{
        vfooter,vheader,vsidebar
   },
    data() {
        return {
            errors: {},
            token: localStorage.getItem('token'),
            transitionName: null
        }
    },
    methods: {
        logout() {
            this.$Progress.start()
            this.callApi('post', 'api/logout')
            localStorage.removeItem('token')
            this.$router.push('/')
            this.$Progress.finish()
            this.notice('success','Great','Successfully logging out!')
        },
        popupCenter({ url, title, w, h }){
            const dualScreenLeft =
                window.screenLeft !== undefined
                    ? window.screenLeft
                    : window.screenX;
            const dualScreenTop =
                window.screenTop !== undefined ? window.screenTop : window.screenY;
    
            const width = window.innerWidth
                ? window.innerWidth
                : document.documentElement.clientWidth
                ? document.documentElement.clientWidth
                : screen.width;
            const height = window.innerHeight
                ? window.innerHeight
                : document.documentElement.clientHeight
                ? document.documentElement.clientHeight
                : screen.height;
    
            const systemZoom = width / window.screen.availWidth;
            const left = (width - w) / 2 / systemZoom + dualScreenLeft;
            const top = (height - h) / 2 / systemZoom + dualScreenTop;
            const newWindow = window.open(url,title,
              `scrollbars=yes,
              width=${w / systemZoom}, 
              height=${h / systemZoom}, 
              top=${top}, 
              left=${left}
              `
            );
            newWindow;
        },
        callApi(type,url,data) {
            return axios({
                method: type,
                url: url,
                data: data,
            })
            .then(function (response) {
                return response
            })
              .catch(function (error) {
                return error.response
            });
        },
        clearFields(obj) {
            Object.keys(obj).forEach((param) => {
                console.log(param);
                if ( (obj[param]).toString() === "[object Object]" ) {
                    clearObjectValues(obj[param]);
                } else {
                    obj[param] = '';
                }
            })  
        },
        notice (type,title,message) {
            this.$notice[type]({
              title: title,
              description: message
            })
          },
          data () {
            return {
            transitionName: 'slide-left'
            }
        },
       
    },
    watch: {
        '$route' (to, from) {
          if (from.path === '/swamp') {
            this.transitionName = 'drain';
          } else {
            this.transitionName = 'slither';
          }
        }
      }
    
}