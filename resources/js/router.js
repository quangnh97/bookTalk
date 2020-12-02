import VueRouter from 'vue-router'

// Pages
import Home from './pages/Home'
import Register from './pages/Register'
import Login from './pages/Login'
import Newfeed from './pages/user/Dashboard'
import Dashboard from './pages/Home'
import AdminDashboard from './pages/admin/Dashboard'
import Profile from './pages/user/Profile'
import EditProfile from './pages/user/EditProfile'
import Friends from './pages/user/Friends'
import FindFriends from './pages/user/FindFriends'
import ChangePhoto from './pages/user/ChangePhoto'
import Request from './pages/user/Request'
import Conversation from './pages/user/Conversation'
import Categories from './pages/user/categories/index'
import Category from './pages/user/categories/category'
import Book from './pages/user/book/index'
import bookOnline from './pages/user/book/readOnline'
import categoriesManager from './pages/admin/categoriesManager'
import usersComment from './pages/admin/usersComment'
import usersManager from './pages/admin/usersManager'
import booksCategory from './pages/admin/booksCategory'

// Routes
const routes = [
  {
    path: '/', name: 'home', component: Home,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/register', name: 'register', component: Register,
    meta: {
      auth: false
    }
  },
  {
    path: '/login', name: 'login', component: Login,
    meta: {
      auth: false
    }
  },
  // USER ROUTES
  {
    path: '/dashboard', name: 'dashboard', component: Dashboard,
    meta: {
      auth: true
    }
  },
    {
        path: '/newfeed', name: 'dashboard', component: Newfeed,
        meta: {
            auth: true
        }
    },

  {
    path: '/profile/:slug', component: Profile,
    meta: {
      auth: true
    }
  },

  {
    path: '/editProfile', name: 'editProfile', component:EditProfile,
    meta: {
      auth: true
    }
  },

  {
    path: '/friends', name: 'friends', component: Friends,
    meta: {
      auth: true
    }
  },
  {
    path:'/conversation', name: 'conversation', component: Conversation,
    meta: {
      auth: true
    }
  },
  // {
  //   path: '/messages', name: 'messages', component: Messages,
  //   meta: {
  //     auth: true
  //   }
  // },

  {
    path: '/findFriends', name: 'findFriends', component: FindFriends,
    meta: {
      auth: true
    }
  },

  {
    path:'/request', name: 'request', component: Request,
    meta: {
      auth: true
    }
  },

  {
    path: '/changePhoto', name: 'changePhoto', component: ChangePhoto,
    meta: {
      auth: true
    }
  },
  // books
    {
        path: '/categories',
        name: 'categories',
        component: Categories,
        meta: {
            auth: true
        }
    },
    {
      path: '/category/:id',
      name: 'category',
      component: Category,
      meta: {
          auth: true
      }
    },
    {
      path: '/book/:id',
      name: 'book',
      component: Book,
      meta: {
          auth: true
      }
    },
    {
        path: '/doc-sach/:id',
        name: 'bookOnline',
        component: bookOnline,
        meta: {
            auth: true
        }
    },
  // ADMIN ROUTES
  {
    path: '/admin',
    redirect: '/admin/categories-manager',
    name: 'admin.dashboard',
    component: AdminDashboard,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    },
      children: [
          {
              path: '/admin/categories-manager',
              name: 'categories-manager',
              component: categoriesManager,
          },
          {
              path: '/admin/users-comment',
              name: 'users-comment',
              component: usersComment,
          },

          {
              path: '/admin/users-manager',
              name: 'users-manager',
              component: usersManager,
          },
          {
              path: '/admin/books-category/:id',
              name: 'books-category',
              component: booksCategory,
          },

      ],
  },

  //

]

const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})

export default router
