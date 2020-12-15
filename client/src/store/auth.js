import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default{
    namespaced: true,
    state: {
        token: null,
        user: [],
        message: ''
    },
    mutations: {
        SET_TOKEN(state, token){
            state.token = token
        },
        SET_USER(state, data){
            state.user = data
        },
        SET_MESSAGE(state, message){
            state.message = message
        }
    },
    actions: {
        async login({commit, dispatch}, credentials){
            await axios.post('login', credentials).then(response => {
                commit('SET_MESSAGE', response.data.success);
                return dispatch('attempt', response.data.token)
            })
        },
        async attempt({commit, state}, token){
            if(token){
                commit('SET_TOKEN', token);
            }

            if(!state.token){
                return 
            }

            await axios.get('profile').then((response) => {
                commit('SET_USER', response.data)
            }).catch(() => {
                commit('SET_TOKEN', null)
                commit('SET_USER', null)
            })
        },
        async logout({commit}){
            await axios.post('logout').then((response) => {
                commit('SET_MESSAGE', response.data.message)
                commit('SET_TOKEN', null)
                commit('SET_USER', null)
            })
        }
    },
    getters: {
        authenticated(state){
            return state.token && state.user
        },
        user(state){
            return state.user
        },
        message(state){
            return state.message
        }
    }
}