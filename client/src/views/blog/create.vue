<template>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModal">Create Blog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
        </div>
    </div>
</div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data(){
        return {
            form: {
                judul: '',
                content: ''
            },
            errors: [],
        }
    },
    computed: {
        ...mapGetters({
            message: 'blog/message'
        })
    },
    methods: {
        submit(){
            this.$Progress.start()
            this.$store.dispatch('blog/storeBlog', this.form).then(() => {
                this.$toasted.show(this.message, {
                    type: 'success',
                    position: 'bottom-right',
                    duration: 2000
                })
                this.$refs.modalClose.click();
                this.form.judul = '';
                this.form.content = '';
            }).catch((e) => {
                this.errors = e.response.data.data
                this.$toasted.show(e.response.data.message, {
                    type: 'error',
                    position: 'bottom-right',
                    duration: 2000
                })
            })
            this.$Progress.finish()
        }
    }
}
</script>

<style>

</style>