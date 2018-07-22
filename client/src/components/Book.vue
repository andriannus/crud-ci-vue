<template>
	<v-container>
		<h1 class="title">Daftar Buku</h1>
	</v-container>
</template>

<script>
export default {
	name: 'Book',
	metaInfo: {
		title: 'Buku | Lemari Buku'
	},

	data: () => ({

	}),

	mounted () {
		this.fetchData()
	},

	methods: {
		fetchData () {
			this.axios.get('books')
				.then(res => {
					console.log(res.data.data)
				})
				.catch(err => {
					console.log(err)
				})
		}
	}
}
</script>