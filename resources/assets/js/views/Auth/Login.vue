<template>
    <form @submit.prevent="login" id="login-form">
        <div class="heading">Login</div>
        <div class="left">
            <small class="error__control" v-if="Object.keys(error).length !== 0">{{error}}</small><br />
            <label for="email">Email</label> <br />
            <input type="email" name="email" id="email" v-model="form.email"/> <br />
            <label for="pass">Password</label> <br />
            <input type="password" name="password" id="pass" v-model="form.password"/> <br />
            <input :disabled="isProcessing" type="submit" value="Login" />
        </div>
        <div class="right">
            <div class="connect">or connect with</div>
            <a @click.stop="socialLogin('facebook')" class="facebook">
                <span class="fontawesome-facebook"></span>
            </a> <br />
            <a @click.stop="socialLogin('twitter')" class="twitter">
                <span class="fontawesome-twitter"></span>
            </a> <br />
            <a @click.stop="socialLogin('google')" class="google-plus">
                <span class="fontawesome-google-plus"></span>
            </a>
        </div>
    </form>
</template>
<script type="text/javascript">
    import Auth from '../../store/auth'
    import {get,post} from '../../helpers/api'
    import Status from '../../helpers/status'
    export default {
        created(){
            if(Auth.state.error){
                this.error = Auth.state.error.includes('+')
                    ? Auth.state.error.replace(/\+/gi,' ') : Auth.state.error;
            }
        },
        data(){
            return {
                form: {
                    email: '',
                    password: ''
                },
                error: {},
                isProcessing: false,
                auth: null,
                status: null,
            }
        },
        methods: {
            login(){
                this.isProcessing = true;
                this.error = {};
                post('/api/login', this.form)
                    .then((response) => {
                        if(response.data.authenticated){
                            Auth.set(response.data.api_token, response.data.user_id);
                            Status.setSuccess('You have successfully logged in!');
                            this.auth = Auth;
                            this.status = Status;
                            this.$router.push('/');
                        }
                        this.isProcessing = false;
                    })
                    .catch((err) => {
                        if(err.response.data.error){
                            this.error = err.response.data.error;
                        }
                        this.isProcessing = false;
                    })
            },
            socialLogin(provider){
                this.isProcessing = true;
                this.error = {};
                get(`/api/social/${provider}`)
                    .then((response) => {
                        if(response.data.error){
                            this.error = err.response.data.error;
                        } else if(response.data.redirectUrl){
                            window.location.href = response.data.redirectUrl;
                        }
                    })
                    .catch((err) => {
                        if(err.response.data.error){
                            this.error = err.response.data.error;
                        }
                        this.isProcessing = false;
                    });
                    this.isProcessing = false;
            }
        }
    }
</script>