export default {
    state: {
        api_token: null,
        user_id: null,
        error: null,
        redirect: null
    },
    initialize(cookie){
        if (cookie){
            var cookie = JSON.parse(cookie);
            this.state.api_token = cookie.api_token;
            this.state.user_id = cookie.user_id;
            this.set(cookie.api_token,cookie.user_id)
            this.state.error = cookie.error;
            this.state.redirect = cookie.redirect;
        } else {
            this.state.api_token = localStorage.getItem('api_token');
            this.state.user_id = parseInt(localStorage.getItem('user_id'));
        }
    },
    set(api_token, user_id){
        localStorage.setItem('api_token',api_token);
        localStorage.setItem('user_id',user_id);
        this.initialize();
    },
    remove(){
        localStorage.removeItem('api_token');
        localStorage.removeItem('user_id');
        this.initialize();
    }
}