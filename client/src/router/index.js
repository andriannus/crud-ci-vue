import Vue from 'vue'
import Router from 'vue-router'
import Header from '@/components/Header'
import Home from '@/components/Home'
import Book from '@/components/Book'
import Author from '@/components/Author'
import Category from '@/components/Category'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: Header,
      children: [
      	{
      		path: '',
          name: 'Home',
          component: Home
      	},
        {
          path: 'book',
          name: 'Buku',
          component: Book,
        },
        {
          path: 'author',
          name: 'Pengarang',
          component: Author
        },
        {
          path: 'category',
          name: 'Kategori',
          component: Category
        }
      ]
    }
  ]
})
