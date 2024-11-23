<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onBeforeMount } from 'vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-dt';

DataTable.use(DataTablesCore);
const productColumns = [
    {
        data: 'name',
        render: function (data, type, row, meta) {
            return '<a href="/product/' + row.id + '">'+ data + '</a>';
        }
    },
    {
        data: 'description',
        render: function (data, type, row, meta) {
            return '<a href="/product/' + row.id + '">'+ data + '</a>';
        }
    },
    { data: 'category' },
    { data: 'base_price' },
    { data: 'final_price' },
    { data: 'discount' },
];

const discountColumns = [
  { data: 'for' },
  { data: 'target' },
  { data: 'amount' },
];
</script>

<template>
    <AppLayout title="Products">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Head title="Products" />

                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                    All Products
                </h2>

                <main class="mt-6">
                    <DataTable
                        :columns="productColumns"
                        class="display"
                        ajax="/products/list"
                    >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Base Price</th>
                                <th>Final Price</th>
                                <th>Discount</th>
                            </tr>
                        </thead>
                    </DataTable>

                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-12 mb-6">
                        All Discounts
                    </h2>

                    <DataTable
                        :columns="discountColumns"
                        class="display"
                        ajax="/discounts/list"
                    >
                        <thead>
                            <tr>
                                <th>For</th>
                                <th>Target</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                    </DataTable>
                </main>
            </div>
        </div>
    </AppLayout>
</template>


<style>
    @import 'datatables.net-dt';
</style>
