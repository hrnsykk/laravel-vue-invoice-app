<template>
    <div class="fixed w-full h-full bg-black bg-opacity-80 left-0 top-0 z-2">
        <div class="relative w-2/5 bg-white p-5 left-1/4 top-1/4">
            <component
                v-bind:is="mapTypeComponents[props.sub_component]"
                v-bind:data="props.data"
                @close_modal="$emit('close_main_modal')"
            >
            </component>
        </div>
    </div>
</template>

<script setup>
import { defineAsyncComponent } from "vue";

const props = defineProps(["sub_component", "data"]);
const emits = defineEmits(["close_main_modal"]);
const mapTypeComponents = {
    category_create: defineAsyncComponent(() =>
        import("./category/create.vue")
    ),
    category_edit: defineAsyncComponent(() => import("./category/edit.vue")),
};
</script>

<style lang="scss" scoped></style>
