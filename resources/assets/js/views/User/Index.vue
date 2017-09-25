<template>
	<div class="recipe__list">
		<div class="recipe__item" v-for="user in users">

		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Latitude</th>
					<th>Longitude</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(user, index) in users">
					<td>{{++index}}</td>
					<td><router-link class="recipe__inner" :to="`/users/${user.id}`">
						<!--<img :src="`/images/${user.image}`" v-if="user.image">-->
						<p class="recipe__name">{{user.name}}</p>
					</router-link></td>
					<td>{{user.email}}</td>
					<td v-if="user.latitude">{{user.latitude}}</td>
					<td v-else>-</td>
					<td v-if="user.longitude">{{user.longitude}}</td>
					<td v-else>-</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
<script type="text/javascript">
	import { get } from '../../helpers/api'
	export default {
		data() {
			return {
				users: []
			}
		},
		created() {
			get('/api/users')
				.then((res) => {
					this.users = res.data.users
				})
		}
	}
</script>
