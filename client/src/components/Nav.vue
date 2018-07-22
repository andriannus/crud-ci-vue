<template>
	<div>
		<v-toolbar app fixed>
			<v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>

			<v-toolbar-title>{{ name }}</v-toolbar-title>
		</v-toolbar>

		<v-navigation-drawer
			app
			fixed
			v-model="drawer"
			width="250"
		>
			<v-toolbar flat>
				<v-list-tile>
					<v-list-tile-title class="title">
						Lemari Buku
					</v-list-tile-title>
				</v-list-tile>
			</v-toolbar>

			<v-divider></v-divider>

			<v-list dense>
				<v-list-tile to="/" @click="setName">
					<v-list-tile-action>
						<v-icon>mdi-home</v-icon>
					</v-list-tile-action>
					<v-list-tile-content>
						Beranda
					</v-list-tile-content>
				</v-list-tile>

				<v-list-tile to="/book" @click="setName">
					<v-list-tile-action>
						<v-icon>mdi-book</v-icon>
					</v-list-tile-action>
					<v-list-tile-content>
						Buku
					</v-list-tile-content>
				</v-list-tile>

				<v-list-tile to="/author" @click="setName">
					<v-list-tile-action>
						<v-icon>mdi-account-box</v-icon>
					</v-list-tile-action>
					<v-list-tile-content>
						Pengarang
					</v-list-tile-content>
				</v-list-tile>

				<v-list-tile to="/category" @click="setName">
					<v-list-tile-action>
						<v-icon>mdi-shape</v-icon>
					</v-list-tile-action>
					<v-list-tile-content>
						Kategori
					</v-list-tile-content>
				</v-list-tile>
			</v-list>
		</v-navigation-drawer>
	</div>
</template>

<script>
export default {
	data: () => ({
		drawer: false,
		name: ''
	}),

	mounted () {
		this.setName()
	},

	methods: {
		setName () {
			this.name = this.$route.name
		}
	}
}
</script>