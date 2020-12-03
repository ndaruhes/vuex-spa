<template>
    <div>
        <!-- NAVBAR -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <template v-if="authenticated">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user mr-1"></i>Halo, <b>{{ user.name }}</b>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#" @click="logout"><i class="fas fa-power-off mr-2"></i>Logout</a>
                        </div>
                    </li>
                </template>
                <template v-else>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/login">
                            <i class="fas fa-sign-in-alt mr-1"></i> Login
                        </router-link>
                    </li>
                </template>
            </ul>
        </nav>

        <!-- SIDEBAR -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="Logo" class="brand-image elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><i class="fab fa-vuejs"></i>uexAhay</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <router-link exact to="/" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Home</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/about" class="nav-link">
                                <i class="nav-icon fas fa-box"></i>
                                <p>About</p>
                            </router-link>
                        </li>
                        <template v-if="authenticated">
                            <li class="nav-item">
                                <router-link :to="{name: 'page.blog'}" class="nav-link">
                                    <i class="nav-icon fas fa-rss"></i>
                                    <p>Blog</p>
                                </router-link>
                            </li>
                        </template>
                    </ul>
                </nav>
            </div>
        </aside>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'
export default {
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
            message: 'auth/message'
        })
    },
    methods: {
        logout(){
            this.$store.dispatch('auth/logout').then(() => {
                this.$router.replace({
                    name: 'home'
                })
                
                this.$toasted.show(this.message, {
                    type: 'success',
                    position: 'bottom-right',
                    duration: 2000
                })
            })
        }
    }
}
</script>