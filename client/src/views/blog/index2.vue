<template>
    <div class="container">
        <h4><i class="fas fa-rss mr-1"></i>Blog</h4>
        <button type="button" class="btn btn-primary btn-sm my-3" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus mr-1"></i> Create blog
        </button>
        <createBlog/>
        <template v-if="loading">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </template>
        <template v-else>
            <!-- <template v-if="blogId != null">  -->
                <showBlog :blogId="blogId"/>
                <editBlog :blogId="blogId"/>
                <deleteBlog :blogId="blogId"/>
            <!-- </template> -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul Blog</th>
                        <th>Content</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(blog, index) in blogs" :key="blog.id">
                        <td>{{++index}}</td>
                        <td>{{blog.judul}}</td>
                        <td>{{blog.content}}</td>
                        <td>
                            <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#detailModal" @click="getBlogId(blog.id)"><i class="fas fa-eye mr-1"></i>Show</button>
                            <button class="btn btn-outline-primary btn-sm mx-1" data-toggle="modal" data-target="#editModal" @click="getBlogId(blog.id)"><i class="fas fa-pencil-alt mr-1"></i>Edit</button>
                            <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteModal" @click="getBlogId(blog.id)"><i class="fas fa-trash-alt mr-1"></i>Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'
import createBlog from './create'
import showBlog from './show'
import editBlog from './edit'
import deleteBlog from './delete'
export default {
    title: 'Manage Blog - VuexSpa',
    components: {createBlog, showBlog, editBlog, deleteBlog},
    data(){
        return{
            blogId: null
        }
    },
    created(){
        this.$Progress.start()
        this.getBlogs();
        this.$Progress.finish()
    },
    computed: {
        ...mapGetters({
            blogs: 'blog/blogs',
            loading: 'blog/loading'
        }),
    },
    methods: {
        getBlogs(){
            this.$store.dispatch('blog/getBlogs')
        },
        getBlogId(id){
            this.blogId = id;
        },
    },
}
</script>

<style>

</style>