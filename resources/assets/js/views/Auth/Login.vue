<template>
    <form class="form-horizontal" role="form" @submit.prevent="login">
        <h1 class="form-title">Login</h1>
        <div class="form-group">
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" v-model="form.email">
                <small class="error__control" v-if="error.email">{{error.email[0]}}</small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Password</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" v-model="form.password">
                <small class="error_control" v-if="error.password">{{error.password[0]}}</small>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-8 col-sm-10">
                <button :disabled="isProcessing" class="btn btn-primary">Login</button>
            </div>
        </div>
    </form>
</template>
<script type="text/javascript">
    import Flash from '../../helpers/flash'
    import Auth from '../../store/auth'
    import { post } from '../../helpers/api'
    export default {
        data() {
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
            login() {
                this.isProcessing = true
                this.error = {}
                post('api/login', this.form)
                    .then((res) => {
                        if(res.data.authenticated) {
                            // set token
                            Auth.set(res.data.api_token, res.data.user_id)
                            Flash.setSuccess('You have successfully logged in.')
                            this.$router.push('/')
                        }
                        this.isProcessing = false
                    })
                    .catch((err) => {
                        if(err.response.status === 422) {
                            this.error = err.response.data
                        }
                        this.isProcessing = false
                    })
            }
        }
    }
</script>
