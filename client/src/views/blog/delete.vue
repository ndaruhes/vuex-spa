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
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal" ref="modalClose">Close</button>
                    <button type="button" class="btn btn-danger btn-sm" @click="deleteBlog">Iyee</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'
export default {
    props: ['blogId'],
    computed: {
        ...mapGetters({
            message: 'blog/message'
        })
    },
    methods: {
        deleteBlog(){
            this.$store.dispatch('blog/deleteBlog', this.$props.blogId).then(()=> {
                this.$toasted.show(this.message, {
                    type: 'success',
                    position: 'bottom-right',
                    duration: 2000
                })
                this.$refs.modalClose.click()
            });
        }
    }
}
</script>

<style>

</style>