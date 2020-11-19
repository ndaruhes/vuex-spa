<template>
    <div class="modal fade" id="showEditmodal" tabindex="-1" role="dialog" aria-labelledby="showEditmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showEditmodalLabel">Blog Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <template v-if="loadingBlog">
                    <div class="d-flex justify-content-center py-3">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <template v-if="mode == 'showMode'">
                        <div class="modal-body">
                            {{ mode }}
                            <h3>{{blog.judul}}</h3>
                            <p>{{blog.content}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </template>
                    <template v-if="mode == 'editMode'">
                        <div class="modal-body">
                            {{ mode }}
                            {{ blog }}
                            <form action="" @submit.prevent="submit">
                                <div class="form-group">
                                    <label for="">Judul Blog</label>
                                    <input type="text" class="form-control" :class="{'is-invalid': errors.judul}" v-model="form.judul">
                                    <div class="invalid-feedback" v-if="errors.judul">{{errors.judul[0]}}</div>
                                </div>

                                <div class="form-group">
                                    <label for="">Content Blog</label>
                                    <textarea class="form-control" :class="{'is-invalid': errors.content}" v-model="form.content"></textarea>
                                    <div class="invalid-feedback" v-if="errors.judul">{{errors.judul[0]}}</div>
                                </div>

                                <button type="button" class="btn btn-outline-secondary btn-sm mr-2" data-dismiss="modal" ref="modalClose">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </form>
                        </div>
                    </template>
                </template>
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
            errors: []
        }
    },
    props: ['blogId', 'mode'],
    computed: {
        ...mapGetters({
            blog: 'blog/blog',
            loadingBlog: 'blog/loadingBlog'
        })
    },
    created(){
        // this.getBlog();
    },
    methods: {
        // getBlog(){
        //     console.log(this.blog.judul);
        // }
    },
    watch: {
        blogId: function(){
            this.$store.dispatch('blog/showBlog', this.$props.blogId);
            console.log(this.$props.blogId);
        }
    }
}
</script>

<style>

</style>