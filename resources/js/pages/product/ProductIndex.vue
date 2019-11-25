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
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">QR</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created/Updated</th>
                                <th scope="col">Action</th>
                                <th scope="col"/>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in products">
                                <th scope="row">
                                    <img class="rounded" :src="product.image" style="width:50px;">
                                </th>
                                <td>{{ product.name }}</td>
                                <td>
                                    <img class="rounded" :src="product.qr" alt=""  style="width:50px;">
                                </td>
                                <td>Description</td>
                                <td>
                                    <small class="text-center text-success">{{ format_date(product.created_at) }}</small>
                                    <br>
                                    <small class="text-center text-info">{{ format_date(product.updated_at) }}</small>
                                </td>
                                <td>
                                    <router-link :to="{name: 'product-view', params: {id: product.id}}" class="btn btn-sm btn-outline-info">
                                        <i class="fa fa-eye"></i>
                                    </router-link>
                                    <router-link :to="{name: 'product-update', params: {id: product.id}}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-pencil-alt"></i>
                                    </router-link>
                                    <i @click="deleteFunc(product)" class="btn btn-sm btn-outline-danger fa fa-trash"></i>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import "photoswipe";
    import Swal from "sweetalert2";
    import moment from "moment";
    import ProductView from "./ProductView";
    import ProductCreate from "./ProductCreate";
    export default {
        data() {
            return {
                products: [],
            }
        },
        created: function() {
            this.loadProduct();
        },
        methods: {
            loadProduct(){
                axios.get('/api/product')
                    .then((response) => {
                        this.products = response.data;
                        console.log("Products", this.products);
                    })
                    .catch((error) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: error,
                            footer: 'Your database might be offline',
                            confirmButtonText: 'Reload',
                            showCancelButton: true,
                            cancelButtonColor: '#d33'
                        }).then((result) => {
                            if(result.value){
                                window.location.href = '/product';
                            }
                        });
                        alert();
                });
            },

            deleteFunc(product){

                const swalWithBootsrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });

                swalWithBootsrapButtons.fire({
                    title: 'Delete '+product.name,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Delete!',
                    cancelButtonText: 'Cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if(result.value){
                        axios.delete('/api/product/'+product.id)
                            .then((response) =>{
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'warning',
                                    title: 'Product has been deleted!',
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                this.loadProduct();
                            })
                            .catch((error) => {
                                swalWithBootsrapButtons.fire(
                                    'There was an error!',
                                    error,
                                    'error'
                                );
                        });
                    } else {
                        swalWithBootsrapButtons.fire(
                            'Cancelled',
                            'Product is safe',
                            'error'
                        )
                    }
                })
            },
            format_date(date){
                return moment(date).format('llll');
            }
        },
        components: {
            "ProductCreate": ProductCreate,
            "ProductView": ProductView
        }
    }
</script>
