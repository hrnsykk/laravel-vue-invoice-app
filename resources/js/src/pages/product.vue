<template>
    <button
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-2"
        type="button"
        @click="create_modal_status = !create_modal_status"
    >
        Add New Product
    </button>
    <div class="relative overflow-x-auto">
        <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <tr>
                    <th scope="col" class="px-6 py-3">Product name</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3">Category</th>
                    <th scope="col" class="px-6 py-3">Control</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="item in products"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                >
                    <th
                        scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                        {{ item.name }}
                    </th>
                    <td class="px-6 py-4">€ {{ item.price }}</td>
                    <td class="px-6 py-4">Laptop</td>
                    <td class="px-6 py-4 flex items-center">
                        <delete_icon
                            @click="deleteProduct(item.id)"
                            fill="red"
                            class="cursor-pointer"
                        />
                        <edit_icon
                            @click="editProduct(item.id)"
                            class="pl-2 cursor-pointer"
                        />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <product_create
        v-if="create_modal_status"
        @close="create_modal_status = !create_modal_status"
        @updateProduct="fetch_products()"
    />
</template>

<script lang="ts" setup>
import axios from "axios";
import { ref } from "vue";
import product_create from "../components/product/create.vue";
import delete_icon from "../components/icons/delete.vue";
import edit_icon from "../components/icons/edit.vue";

const create_modal_status = ref(false);
const products = ref();

const fetch_products = () => {
    console.log("fetch_products work");
    axios.get("/api/product").then((response) => {
        products.value = response.data;
    });
};

fetch_products();

const deleteProduct = (id) => {
    axios.delete(`/api/product/${id}`).then((response) => {
        if (response) fetch_products();
    });
};

const editProduct = (id) => {};
</script>

<style lang="scss" scoped></style>
