<template>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <template v-if="loadingBlog">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <form action="" @submit.prevent="submit">
                            <div class="form-group">
                                <label for="">Judul Blog</label>
                                <input type="text" class="form-control" :class="{'is-invalid': errors.judul}" v-model="blog.judul">
                                <div class="invalid-feedback" v-if="errors.judul">{{errors.judul[0]}}</div>
                            </div>

                            <div class="form-group">
                                <label for="">Content Blog</label>
                                <textarea class="form-control" :class="{'is-invalid': errors.content}" v-model="blog.content"></textarea>
                                <div class="invalid-feedback" v-if="errors.content">{{errors.content[0]}}</div>
                            </div>

                            <button type="button" class="btn btn-outline-secondary btn-sm mr-2 float-left" data-dismiss="modal" ref="modalClose">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm d-flex float-left">
                                Submit
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
                    </template>
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
            form: {
                judul: '',
                content: ''
            },
            errors: [],
            btnLoading: false
        }
    },
    props: ['blogId'],
    computed: {
        ...mapGetters({
            blog: 'blog/blog',
            loadingBlog: 'blog/loadingBlog',
            message: 'blog/message'
        })
    },
    watch: {
        blogId: function(){
            this.$store.dispatch('blog/showBlog', this.$props.blogId);
            this.errors = []
        }
    },
    methods : {
        submit(){
            this.btnLoading = true
            this.form.judul = this.blog.judul
            this.form.content = this.blog.content
            this.$store.dispatch('blog/updateBlog', [this.$props.blogId, this.form]).then(() => {
                this.$toasted.show(this.message, {
                    type: 'success',
                    position: 'bottom-right',
                    duration: 2000
                });
                this.$refs.modalClose.click();
                this.form.judul = '';
                this.form.content = '';
                this.btnLoading = false
            }).catch((e) => {
                this.errors = e.response.data.data
                this.$toasted.show(e.response.data.message, {
                    type: 'error',
                    position: 'bottom-right',
                    duration: 2000
                });
                this.btnLoading = false
            })
        }

    }
}
</script>

<style>

</style>