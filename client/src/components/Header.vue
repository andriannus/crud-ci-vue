<template>
	<div>
		<Nav />

		<v-content>
			<router-view />
		</v-content>

		<v-footer app>
			<v-layout justify-center row wrap>
				<v-flex text-xs-center py-3>
					&copy; 2018 - <strong>Lemari Buku</strong>
				</v-flex>
			</v-layout>
		</v-footer>
	</div>
</template>

<script>
import Nav from './Nav'

export default {
	name: 'Header',
	metaInfo: {
		title: 'Selamat Datang di Lemari Buku'
	},

	data: () => ({
		isActive: false
	}),

	methods: {
		switchMenu () {
			this.isActive = !this.isActive
		}
	},

	components: {
		Nav
	}
}
</script>
