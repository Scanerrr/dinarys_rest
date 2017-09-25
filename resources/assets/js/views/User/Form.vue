<template>
	<div class="recipe__show">
		<div class="recipe__header">
			<h3>{{action}} User</h3>
			<div class="row col-sm-offset-7 col-sm-10">
				<button class="btn btn-primary" @click="save" :disabled="isProcessing">Save</button>
				<button class="btn" @click="$router.back()" :disabled="isProcessing">Cancel</button>
			</div>
		</div>
		<div class="recipe__row">
			<div class="form-horizontal">
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
						<input type="email" class="form-control form__email" v-model="form.email"></input>
						<small class="error__control" v-if="error.email">{{error.email[0]}}</small>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-6">
						<input type="password" class="form-control form__password" v-model="form.password"></input>
						<small class="error__control" v-if="error.password">{{error.password[0]}}</small>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3 col-sm-offset-3">
						<label class="control-label">Latitide</label>
						<input type="text" class="form-control" v-model="form.latitude"></input>
					</div>
					<div class="col-sm-3">
						<label class="control-label">Longitude</label>
						<input type="text" class="form-control" v-model="form.longitude"></input>
					</div>
				</div>
			</div>
		</div>

	</div>
</template>
<script type="text/javascript">
	import Vue from 'vue'
	import Flash from '../../helpers/flash'
	import { get, post } from '../../helpers/api'
	import { toMulipartedForm } from '../../helpers/form'

	export default {

		data() {
			return {
				form: {},
				error: {},
				isProcessing: false,
				initializeURL: `/api/users/create`,
				storeURL: `/api/users`,
				action: 'Create'
			}
		},
		created() {
			if(this.$route.meta.mode === 'edit') {
				this.initializeURL = `/api/users/${this.$route.params.id}/edit`
				this.storeURL = `/api/users/${this.$route.params.id}?_method=PUT`
				this.action = 'Update'
			}
			get(this.initializeURL)
				.then((res) => {
					Vue.set(this.$data, 'form', res.data.form)
                })
		},
		methods: {
			save() {
				const form = toMulipartedForm(this.form, this.$route.meta.mode)
				post(this.storeURL, form)
				    .then((res) => {
				        if(res.data.saved) {
				            Flash.setSuccess(res.data.message)
				            this.$router.push(`/users/${res.data.id}`)
				        }
				        this.isProcessing = false
				    })
				    .catch((err) => {
				        if(err.response.status === 422) {
				            this.error = err.response.data
				        }
				        this.isProcessing = false
				    })
			},
			remove(type, index) {
				if(this.form[type].length > 1) {
					this.form[type].splice(index, 1)
				}
			}
		}
	}
</script>
