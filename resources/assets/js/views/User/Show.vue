<template>
	<div class="recipe__show">
		<div class="recipe__row">
			<div class="recipe__details">
				<div class="recipe__details_inner">
					<h1 class="recipe__title">{{user.name}}</h1>
					<p class="recipe__description">{{user.email}}</p>
					<div v-if="authState.api_token/* && authState.user_id === user.id*/">
						<router-link :to="`/users/${user.id}/edit`" class="btn btn-primary">
							Edit
						</router-link>
						<button v-show="authState.user_id !== user.id" class="btn btn-danger" @click="remove" :disabled="isRemoving">Delete</button>
					</div>
				</div>
			</div>
		</div>

	</div>
</template>
<script type="text/javascript">
	import Auth from '../../store/auth'
	import Flash from '../../helpers/flash'
	import { get, del } from '../../helpers/api'
	export default {
		data() {
			return {
				authState: Auth.state,
				isRemoving: false,
				user: {
					user: {}
				}
			}
		},
		created() {
			get(`/api/users/${this.$route.params.id}`)
				.then((res) => {
					this.user = res.data.user
				})
		},
		methods: {
			remove() {
				this.isRemoving = false
				del(`/api/users/${this.$route.params.id}`)
					.then((res) => {
						if(res.data.deleted) {
							Flash.setSuccess('You have successfully deleted user!')
							this.$router.push('/')
						}
					})
			}
		}
	}
</script>
