<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Page visits</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#" class="btn btn-sm btn-outline-success"><i class="fa fa-plus"></i> Add Product</a>
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
                                <th scope="col">Category</th>
                                <th scope="col">Type</th>
                                <th scope="col">Description</th>
                                <th scope="col">Supplier</th>
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
                                <td>{{ product.category.name}}</td>
                                <td>{{ product.type }}</td>
                                <td>Description</td>
                                <td>{{ product.supplier.name}}</td>
                                <td>
                                    <small class="text-center text-success">{{ format_date(product.created_at) }}</small>
                                    <br>
                                    <small class="text-center text-info">{{ format_date(product.updated_at) }}</small>
                                </td>
                                <td>
                                    <i class="btn btn-sm btn-outline-darker fa fa-eye"></i>
                                    <i class="btn btn-sm btn-outline-primary fas fa-pencil-alt"></i>
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
    export default {
        data() {
            return {
                products: []
            }
        },
        created: function() {
            this.loadProduct();
        },
        methods: {
            loadProduct(){
                axios.get('/api/product')
                    .then((response) => {
                        console.log("Products", response.data);
                        this.products = response.data;
                    })
                    .catch((error) => {
                        alert("Error");
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
                                swalWithBootsrapButtons.fire(
                                    'Deleted!',
                                    product.name+' has been Deleted!',
                                    'success'
                                );
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
        computed: {

        }
    }
</script>
