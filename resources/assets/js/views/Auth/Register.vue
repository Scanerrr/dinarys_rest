<template>
    <form class="form-horizontal" role="form" @submit.prevent="register">
        <h1 class="form-title">Create an Account</h1>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" v-model="form.name">
                <small class="error__control" v-if="error.name">{{error.name[0]}}</small>
            </div>
        </div>
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
                <small class="error__control" v-if="error.password">{{error.password[0]}}</small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Confirm Password</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" v-model="form.password_confirmation">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-8 col-sm-10">
                <button :disabled="isProcessing" class="btn btn-primary">Register</button>
            </div>
        </div>
    </form>
</template>
<script type="text/javascript">
    import Flash from '../../helpers/flash'
    import { post } from '../../helpers/api'
    export default {
        data() {
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
            register() {
                this.isProcessing = true
                this.error = {}
                post('api/register', this.form)
                    .then((res) => {
                        if(res.data.registered) {
                            Flash.setSuccess('Congratulations! You have now successfully registered.')
                            this.$router.push('/login')
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
