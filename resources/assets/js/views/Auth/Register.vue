<template>
    <form @submit.prevent="register" id="login-form">
        <div class="heading">Registration</div>
        <div class="left">
            <small class="error__control" v-show="Object.keys(error).length !== 0">{{error}}</small><br />

            <label for="email">Email</label> <br />
            <input type="email" name="email" id="email" v-model="form.email"/> <br />

            <label for="name">Name</label> <br />
            <input type="text" name="email" id="name" v-model="form.name"/> <br />

            <label for="password">Password</label> <br />
            <input type="password" name="password" id="pass" v-model="form.password"/> <br />

            <label for="passConfirm">Confirm password</label> <br />
            <input type="password" name="password" id="passConfirm" v-model="form.password_confirmation"/> <br />

            <input :disabled="isProcessing" type="submit" value="Register" />
        </div>
        <div class="right">
            <div class="connect">or register with</div>
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
    import {post} from '../../helpers/api'
    import Status from '../../helpers/status'
    import Auth from '../../store/auth'

    export default {
        data(){
            return {
                form: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                error: {},
                isProcessing: false
            }
        },
        methods: {
            register(){
                this.isProcessing = true;
                this.error = {};
                post('/api/register', this.form)
                    .then((response) => {
                        if(response.data.registered){
                            Auth.set(response.data.api_token, response.data.user_id);
                            console.log(Auth.state);
                            Status.setSuccess('You have successfully created an account!');
                            this.$router.push('/');
                        }
                        this.isProcessing = false;
                    })
                    .catch((err) => {
                        if(err.response.status === 422 && err.response.data.errors){
                            this.error = err.response.data.errors;
                        }
                        this.isProcessing = false;
                    })
            }
        }
    }
</script>