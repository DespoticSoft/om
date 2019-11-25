<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Products</h3>
                            </div>
                            <div class="col text-right">
                                <router-link :to="{name: 'product-create'}" class="btn btn-outline-success"><i class="fa fa-plus"></i> Add Product</router-link>
                                <router-link :to="{name: 'product-create', query:{bulk: true}}" class="btn btn-outline-primary"><i class="fa fa-cube"></i> Bulk Add Product</router-link>
                                <button class="btn btn-outline-info"><i class="fa fa-cubes"></i> Add Item</button>
                                <!--                                <router-link :to="{name: 'item-create'}" class="btn btn-outline-info"><i class="fa fa-cubes"></i> Add Item</router-link>-->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <v-data-table
                            :headers="headers"
                            :items="categories"
                            :items-per-page="5"
                            class="elevation-1"
                            loading loading-text="Loading.. Please wait"
                        >
                        </v-data-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                headers: [
                    {
                        text: 'Name',
                        align: 'left',
                        sortable: false,
                        value: 'name',
                    },
                    { text: 'Parent', value: 'parent' },
                    { text: 'Description', value: 'description' },
                    { text: 'Status', value: 'status' },
                    { text: 'Updated By', value: 'updated_by' },
                    { text: 'Created/Updated at', value: 'created_at' },
                ],
                categories: [
                    {
                        name: '',
                        parent: '',
                        description: '',
                        status: '',
                        updated_by: '',
                        created_at:'',
                        updated_at: ''
                    }
                ],
            }
        },
        created(){
            this.getCategory();
        },
        methods: {
            getCategory(){
                axios.get('/api/product-category')
                    .then((result) => {
                        this.categories = result.data;
                    })
            }
        }
    }
</script>
