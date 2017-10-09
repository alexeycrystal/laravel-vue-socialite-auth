<template>
    <div class="container">
        <div class="navbar">
            <div class="navbar__brand">
                <router-link to="/">Laravel & Vue - Socialite</router-link>
            </div>
            <ul class="navbar__list">
                <li class="navbar__item" v-if="!checkAuthStatus">
                    <router-link to="/login">Login</router-link>
                </li>
                <li class="navbar__item" v-if="!checkAuthStatus">
                    <router-link to="/register">Register</router-link>
                </li>
                <li class="navbar__item" v-if="checkAuthStatus">
                    <a @click.stop="logout">Logout</a>
                </li>
            </ul>
        </div>
        <router-view></router-view>
    </div>
</template>
<script type="text/javascript">
    import Auth from './store/auth'
    import {post} from './helpers/api'

    export default {
        created(){
            Auth.initialize(this.$cookie.get('authentication'));
            this.$cookie.delete('authentication');
            if(Auth.state.redirect){
                this.$router.push(Auth.state.redirect);
            }
        },
        data() {
            return {
                auth: Auth.state
            }
        },
        computed: {
            checkAuthStatus(){
                if(this.auth.api_token && this.auth.user_id){
                    return true
                }
                return false
            }
        },
        methods:{
            logout(){
                post('/api/logout')
                    .then((response) => {
                        if(response.data.logged_out){
                            Auth.remove();
                            this.$router.push('/login');
                        }
                    })
            }
        }
    }
</script>