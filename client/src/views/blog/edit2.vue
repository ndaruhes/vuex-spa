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
            errors: []
        }
    },
    props: ['blogId'],
    computed: {
        ...mapGetters({
            blog: 'blog/blog',
            loadingBlog: 'blog/loadingBlog'
        })
    }
}
</script>

<style>

</style>