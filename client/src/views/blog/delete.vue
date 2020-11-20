<template>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete confirm?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Lu yakin broow?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm float-left" data-dismiss="modal" ref="modalClose">Close</button>
                    <button type="button" class="btn btn-danger btn-sm d-flex float-left" @click="deleteBlog">
                        Iyee
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
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'
export default {
    data(){
        return{
            btnLoading: false
        }
    },
    props: ['blogId'],
    computed: {
        ...mapGetters({
            message: 'blog/message'
        })
    },
    methods: {
        deleteBlog(){
            this.btnLoading = true
            this.$store.dispatch('blog/deleteBlog', this.$props.blogId).then(()=> {
                this.$toasted.show(this.message, {
                    type: 'success',
                    position: 'bottom-right',
                    duration: 2000
                })
                this.$refs.modalClose.click()
                this.btnLoading = false
            });
        }
    }
}
</script>

<style>

</style>