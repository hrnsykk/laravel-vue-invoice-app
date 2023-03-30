import { defineStore } from "pinia";
import axios from "axios";

export const useCategoriesStore = defineStore('categories', {
    state : () => ({categories : null}),
    actions: {
        fetchCategories(){
            axios.get("/api/category")
            .then( response =>{
                this.categories = response.data
            })
        },
        save(data){
            axios.post("/api/category", data.form)
            .then(response =>{
                this.categories.push(response.data)
            })
        },
        delete(id)
        {
            axios.delete(`/api/category/${id}`)
            .then(response =>{
                this.categories.filter( (item, index) => {
                    if(response.data.id == item.id){
                        this.categories.splice(index)
                    }
                })
            })
        },
        update(data)
        {
            console.log(data.props.data)
        }
    },
    getters:{
        getCategories(state){
            return state.categories
        }
    }
})