<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    product: {
        type: Array,
    },
});

</script>

<template>
    <AppLayout title="Products">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Head title="Product" />

                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                    Product
                </h2>

                <main class="mt-6">
                    <div class="p-6 my-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="pb-6">
                            <span class="mr-2">{{ props.product.name}}</span>-<span class="ml-2">{{ props.product.category}}</span>
                        </div>
                        <div class="pb-6">
                            {{ props.product.description }}
                        </div>
                        <div class="pb-6">
                            <span class="mr-4" :class="{ 'line-through': props.product.final_price != props.product.base_price}">Base Price - {{ props.product.base_price }}</span>
                            <span v-if="props.product.final_price != props.product.base_price" class="ml-4">Final Price - {{ props.product.final_price }}</span>
                        </div>
                    </div>

                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                        Active Discounts
                    </h2>

                    <div class="p-6 my-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div v-for="discount in props.product.discounts.data" class="pb-6">
                            <span class="mr-2">
                                {{ discount.for }} -
                            </span>
                            <span class="mr-2">
                                {{ discount.target }}
                            </span>
                            <span class="mr-2">
                                {{ discount.amount }}
                            </span>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </AppLayout>
</template>
