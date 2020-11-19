<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
            <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="Logo" class="brand-image elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE3</span>
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
                        <router-link :to="{name: 'page.blog'}" class="nav-link">
                            <i class="nav-icon fas fa-rss"></i>
                            <p>Blog</p>
                        </router-link>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>