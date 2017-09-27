<template>
    <form @submit.prevent="login" id="login-form">
        <div class="heading">Login</div>
        <div class="left">
            <small class="error__control" v-if="Object.keys(error).length !== 0">{{error}}</small><br />
            <label for="email">Email</label> <br />
            <input type="email" name="email" id="email" v-model="form.email"/> <br />
            <label for="password">Password</label> <br />
            <input type="password" name="password" id="pass" v-model="form.password"/> <br />
            <input :disabled="isProcessing" type="submit" value="Login" />
        </div>
        <div class="right">
            <div class="connect">or connect with</div>
            <a href="" class="facebook">
                <span class="fontawesome-facebook"></span>
            </a> <br />
            <a href="" class="twitter">
                <span class="fontawesome-twitter"></span>
            </a> <br />
            <a href="" class="google-plus">
                <span class="fontawesome-google-plus"></span>
            </a>
        </div>
    </form>
</template>
<script type="text/javascript">
    import Auth from '../../store/auth'
    import {post} from '../../helpers/api'
    import Status from '../../helpers/status'
    export default {
        data(){
            return {
                form: {
                    email: '',
                    password: ''
                },
                error: {},
                isProcessing: false
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
            }
        }
    }
</script>