<template>
<div class="wrapper">
  <Navbar />
  <div class="content-wrapper">
    <Toast :message="toastMessage" :status="toastStatus"/>
    <router-view></router-view>
    <vue-progress-bar></vue-progress-bar>
  </div>
  <Footer />
</div>
</template>
<script>
import {bus} from './main'
import Navbar from './components/Navbar'
import Footer from './components/Footer'
import Toast from './components/Toast'

export default {
  data(){
    return {
      toastMessage: '',
      toastStatus: ''
    }
  },
  components: { Navbar, Footer, Toast },
  mounted() {
    window.$('body').Layout();
    window.$('[data-widget="pushmenu"]').PushMenu();
    window.$('[data-widget="control-sidebar"]').ControlSidebar();
    window.$('ul[data-widget="treeview"]').Treeview('init');
    window.$('.dropdown').Dropdown();
    window.$('ul[data-widget="treeview"]').overlayScrollbars();
    document.body.classList.add('hold-transition', 'sidebar-mini', 'layout-fixed', 'layout-navbar-fixed', 'layout-footer-fixed');
  },
  created(){
    bus.$on('setToastMessage', ({message, status}) => {
      this.toastMessage = message;
      this.toastStatus = status;
    })
  }
}
</script>

<style lang="scss">
  // AdminLTE
  @import '~admin-lte/dist/css/adminlte.css';
  @import '~overlayscrollbars/css/OverlayScrollbars.css';
</style>