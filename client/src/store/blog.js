import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default{
    namespaced: true,
    state: {
        blogs: [],
        blog: {},
        loading: true,
        loadingBlog: false,
        message: ''
    },
    mutations: {
        SET_BLOGS(state, data){
            state.blogs = data;
        },
        SET_BLOG(state, data){
            state.blog = data
        },
        SET_LOADING_STATUS(state, status){
            state.loading = status;
        },
        SET_BLOG_LOADING_STATUS(state, status){
            state.loadingBlog = status;
        },
        SET_MESSAGE(state, message){
            state.message = message
        }
    },
    actions: {
        async getBlogs({commit}){
            await axios.get('blog').then((response) => {
                commit('SET_BLOGS', response.data);
                commit('SET_LOADING_STATUS', false);
            })
        },
        async storeBlog({commit, dispatch}, credentials){
            await axios.post('blog', credentials).then((response) => {
                commit('SET_MESSAGE', response.data)
                return dispatch('getBlogs');
            })
        },
        async showBlog({commit}, id){
            commit('SET_BLOG_LOADING_STATUS', true);
            await axios.get(`blog/${id}`).then((response) => {
                commit('SET_BLOG', response.data.blog);
                commit('SET_BLOG_LOADING_STATUS', false);
            })
        },
        async updateBlog({commit, dispatch}, [id, credentials]){
            await axios.patch(`blog/${id}`, credentials).then((response) => {
                commit('SET_MESSAGE', response.data);
                return dispatch('getBlogs');
            });
        },
        async deleteBlog({commit, dispatch}, id){
            await axios.delete(`blog/${id}`).then((response) => {
                commit('SET_MESSAGE', response.data);
                return dispatch('getBlogs');
            })
        }
    },
    getters: {
        blogs(state){
            return state.blogs
        },
        blog(state){
            return state.blog
        },
        loading(state){
            return state.loading
        },
        loadingBlog(state){
            return state.loadingBlog
        },
        message(state){
            return state.message
        }
    }
}