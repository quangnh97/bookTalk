import VueRouter from 'vue-router'

// Pages
import Home from './pages/Home'
import Register from './pages/Register'
import Login from './pages/Login'
import Dashboard from './pages/user/Dashboard'
import AdminDashboard from './pages/admin/Dashboard'
import Profile from './pages/user/Profile'
import EditProfile from './pages/user/EditProfile'
import Friends from './pages/user/Friends'
import FindFriends from './pages/user/FindFriends'
import ChangePhoto from './pages/user/ChangePhoto'
import Request from './pages/user/Request'
import Conversation from './pages/user/Conversation'

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
  // ADMIN ROUTES
  {
    path: '/admin', name: 'admin.dashboard', component: AdminDashboard,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },

  //
  
]

const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})

export default router