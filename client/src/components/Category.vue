<template>
	<v-container>
		<h1 class="subheader">Daftar Kategori</h1>

		<v-card>
			<v-card-title>
			<v-btn color="primary" @click="dialogAdd = true">Tambah Data</v-btn>

				<v-spacer></v-spacer>

				<v-text-field
					v-model="search"
					append-icon="search"
					label="Cari Disini"
				></v-text-field>

			</v-card-title>
			<v-data-table
				:headers="headers"
				:items="categories"
				:search="search"
				class="elevation-1"
			>
				<template slot="items" slot-scope="props">
					<td>{{ props.item.kategori }}</td>
					<td>{{ props.item.deskripsi }}</td>
					<td>
						<v-btn fab small color="primary" title="Ubah">
							<v-icon>mdi-pencil</v-icon>
						</v-btn>

						<v-btn fab small color="error" title="Hapus" @click="deleteConfirm(props.item.id_kategori)">
							<v-icon>mdi-delete</v-icon>
						</v-btn>
					</td>
				</template>

				<template slot="no-data">
					<v-alert
						:value="true"
						color="error"
						icon="mdi-magnify"
						outline
					>Tidak Ada Data</v-alert>
				</template>

				<template slot="no-results">
					<v-alert
						:value="true"
						color="error"
						icon="mdi-magnify"
						outline
					>Kategori tidak ditemukan</v-alert>
				</template>

				<template slot="pageText" slot-scope="props">
					Data ke {{ props.pageStart }} - {{ props.pageStop }} dari {{ props.itemsLength }}
				</template>
			</v-data-table>
		</v-card>

		<v-dialog v-model="dialogAdd" max-width="500px">
			<v-divider></v-divider>
			<v-card>
				<v-card-title>Tambah Kategori</v-card-title>
				<v-card-text>
					<v-form ref="form">
						<v-text-field
							v-model="kategori"
							:counter="10"
							label="Kategori"
						></v-text-field>

						<v-textarea
							v-model="deskripsi"
							:counter="100"
							label="Deskripsi"
						></v-textarea>
					</v-form>
				</v-card-text>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn flat color="error" @click="reset">Batal</v-btn>
					<v-btn flat color="primary" @click="saveCategory">Simpan</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>

		<v-dialog v-model="dialogConfirm" max-width="300px">
			<v-divider></v-divider>
			<v-card>
				<v-card-text>
					<p class="font-weight-bold">Apakah Anda ingin menghapus kategori yang dipilih?</p>
				</v-card-text>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn flat color="error" @click="dialogConfirm = false">Batal</v-btn>
					<v-btn flat color="primary" @click="deleteCategory(id)">Oke</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>

		<v-snackbar
			v-model="snackbar"
			:top="true"
			:right="true"
			:timeout="2000"
			color="success"
		>{{ text }}</v-snackbar>
	</v-container>
</template>

<script>
export default {
	name: 'Home',
	metaInfo: {
		title: 'Kategori | Lemari Buku'
	},

	data: () => ({
		id: '',
		kategori: '',
		deskripsi: '',
		search: '',
		text: '',
		dialogAdd: false,
		dialogConfirm: false,
		snackbar: false,
		headers: [
			{
				text: 'Kategori',
				value: 'kategori',
			},
			{
				text: 'Deskripsi',
				value: 'deskripsi',
				width: '50%'
			},
			{
				sortable: false,
				value: 'actions'
			}
		],
		categories: []
	}),

	mounted () {
		this.fetchData()
	},

	methods: {
		fetchData () {
			this.axios.get('categories')
				.then(res => {
					this.categories = res.data.data
				})
				.catch(err => {
					console.log(err)
				})
		},

		saveCategory () {
			let data = 	'kategori=' + this.kategori +
									'&deskripsi=' + this.deskripsi

			this.axios.post('categories', data)
				.then(res => {
					this.dialogAdd = false
					this.reset()
					this.fetchData()
					this.snackbar = true
					this.text = res.data.message
				})
				.catch(err => {
					console.log(err)
				})
		},

		deleteCategory (id) {
			this.axios.delete('categories?id=' + id)
				.then(res => {
					if (res.data.success) {
						this.dialogConfirm = false
						this.fetchData()
						this.snackbar = true
						this.text = res.data.message
					}
				})
				.catch(err => {
					console.log(err)
				})
		},

		deleteConfirm (id) {
			this.id = id
			this.dialogConfirm = true
		},

		reset () {
			this.$refs.form.reset()
			this.dialogAdd = false
		}
	}
}
</script>