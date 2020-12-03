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
                        <form action="" @submit.prevent="submit" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Cover Blog</label>
                                <input type="file" v-on:change="onImageChange" class="form-control" :class="{'is-invalid': errors.cover}" ref="fileUpload">
                                <div class="invalid-feedback" v-if="errors.cover">{{errors.cover[0]}}</div>
                            </div>

                            <div class="form-group" v-if="image">
                                <img :src="image" class="img-responsive w-100">
                            </div>
                            <div class="form-group" v-else>
                                <img :src="'http://127.0.0.1:8000/storage/images/blogs/'+blog.cover" class="img-responsive w-100">
                            </div>

                            <div class="form-group">
                                <label for="">Judul Blog</label>
                                <input type="text" class="form-control" :class="{'is-invalid': errors.judul}" v-model="blog.judul">
                                <div class="invalid-feedback" v-if="errors.judul">{{errors.judul[0]}}</div>
                            </div>

                            <div class="form-group">
                                <label for="">Content Blog</label>
                                <ckeditor :editor="editor" :class="{'is-invalid': errors.content}" v-model="blog.content"></ckeditor>
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
import {bus} from '../../main'
import {mapGetters} from 'vuex'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

export default {
    data(){
        return{
            form: {
                cover: '',
                judul: '',
                content: ''
            },
            image: '',
            editor: ClassicEditor,
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
            this.image = ''
        }
    },
    methods : {
        submit(){
            this.btnLoading = true
            const data = new FormData();
            data.append('cover', this.form.cover);
            data.append('judul', this.blog.judul);
            data.append('content', this.blog.content);
            // this.form.judul = this.blog.judul
            // this.form.content = this.blog.content
            this.$store.dispatch('blog/updateBlog', [this.$props.blogId, data]).then(() => {
                this.$refs.modalClose.click();
                this.btnLoading = false
                bus.$emit('setToastMessage', {message: this.message, status: 'success'})
                window.$('.toast').toast('show')
            }).catch(e => {
                console.log(e.response);
                this.errors = e.response.data.data
                this.btnLoading = false
                bus.$emit('setToastMessage', {message:  e.response.data.message, status: 'error'})
                window.$('.toast').toast('show')
            })
        },
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            this.form.cover = files[0].name
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            if(file.type == 'image/x-icon' || file.type == 'image/jpg' || file.type == 'image/png' || file.type == 'image/jpeg'){
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            }else{
                console.log('ups bro gk bisa ditampilin');
            }
        },
    }
}
</script>

<style>

</style>