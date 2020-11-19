<template>
  <h1>Home Page</h1>
</template>

<script>
export default {
  title: 'Home - VuexSpa',
  created(){
    this.$Progress.start()
    this.$Progress.finish()
  }
}
</script>

<style>

</style>