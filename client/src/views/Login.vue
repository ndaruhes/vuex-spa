<template>
    <div class="d-flex justify-content-center mt-5">
        <div class="col-md-4">
            <form action="" @submit.prevent="submit">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" v-model="form.email">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" v-model="form.password">
                </div>

                <button type="submit" class="btn btn-primary btn-sm d-flex">
                    Login
                    <template v-if="btnLoading">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="20px" height="22.5px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="ml-1">
                            <rect x="17.5" y="30" width="15" height="40" fill="#85a2b6">
                                <animate attributeName="y" repeatCount="indefinite" dur="0.7299270072992701s" calcMode="spline" keyTimes="0;0.5;1" values="18;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.145985401459854s"></animate>
                                <animate attributeName="height" repeatCount="indefinite" dur="0.7299270072992701s" calcMode="spline" keyTimes="0;0.5;1" values="64;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.145985401459854s"></animate>
                                </rect>
                                <rect x="42.5" y="30" width="15" height="40" fill="#bbcedd">
                                <animate attributeName="y" repeatCount="indefinite" dur="0.7299270072992701s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.072992700729927s"></animate>
                                <animate attributeName="height" repeatCount="indefinite" dur="0.7299270072992701s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.072992700729927s"></animate>
                                </rect>
                                <rect x="67.5" y="30" width="15" height="40" fill="#dce4eb">
                                <animate attributeName="y" repeatCount="indefinite" dur="0.7299270072992701s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
                                <animate attributeName="height" repeatCount="indefinite" dur="0.7299270072992701s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
                            </rect>
                        </svg>
                    </template>
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'
export default {
    title: 'Login - VuexAhay',
    data(){
        return {
            form: {
                email: '',
                password: ''
            },
            btnLoading: false
        }
    },
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
            message: 'auth/message'
        }),
    },
    methods: {
        submit(){
            this.btnLoading = true
            this.$store.dispatch('auth/login', this.form).then(() => {
                this.$toasted.show(this.message, {
                    type: 'success',
                    position: 'bottom-right',
                    duration: 2000
                })
                this.btnLoading = false
                this.$router.replace({
                    name: 'page.blog'
                })
            }).catch((e) => {
                this.$toasted.show(e.response.data.error, {
                    type: 'error',
                    position: 'bottom-right',
                    duration: 2000
                })
                this.btnLoading = false
            })
        }
    }
}
</script>

<style>

</style>