<template>
    <div class="toast alert-position" role="alert" aria-live="assertive" aria-atomic="true" data-animation="true" data-delay="1000" data-autohide="false" :class="{'bg-success': status == 'success', 'bg-danger': status == 'error'}">
        <div class="toast-header">
            <img src="@/assets/rock.png" class="rounded mr-2" alt="rock" width="20" v-if="status == 'success'">
            <img src="@/assets/sad.png" class="rounded mr-2" alt="rock" width="20" v-else-if="status == 'error'">
            <strong class="mr-auto" v-if="status == 'success'">Mantap broo</strong>
            <strong class="mr-auto" v-else-if="status == 'error'">Ahh yg bener dong</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ message }}
        </div>
    </div>
</template>

<script>
export default {
    props: ['message', 'status'],
}
</script>

<style lang="scss">
    ::-webkit-scrollbar {
        width: 5px;
    }

    ::-webkit-scrollbar-track {
        background: #666;
    }

    ::-webkit-scrollbar-thumb {
        background: #232323;
    }
    .alert-position {
        position: fixed; 
        bottom: 65px; 
        right: 20px;
        // z-index: 1000;

        @media screen and (max-width: 768px){
            // bottom: 40px;
            // right: 40px;
        }
    }
</style>