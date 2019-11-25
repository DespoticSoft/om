<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card shadow text-left">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">Store</h6>
                                    <h2 class="mb-0">View Product</h2>
                                </div>
                            </div>
                        </div>
                            <div class="card-body text-center">
                                <div class="row">
                                    <div class="col">
                                        <img :src="product.image" alt="" style="width: 200px; display: block; margin: auto;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h1>{{product.name}}</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p>{{ product.description }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <button @click="$router.go(-1)" type="button" class="btn btn-default btn-block">Back</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueDropify from 'vue-dropify';
    import axios from 'axios';
    import "dropify";
    import Swal from "sweetalert2";
    import CategoryCreate from "./CategoryCreate";
    export default {
        data: () => {
            return {
                product: {
                    id: '',
                    name: '',
                    image: [],
                    qr: 'https://images.vexels.com/media/users/3/158122/isolated/preview/39e6da6d7ac6e177c43e50a97eb9de4d-qr-code-sticker-by-vexels.png',
                    description: '',
                    category_id: '',
                },

            }
        },
        mounted: function(){
            // alert(JSON.stringify(this.$route.params.id));
            this.product.id = this.$route.params.id;
            this.getProduct();
        },
        created(){
        },
        methods: {
            getProduct(){
                axios.get('/api/product/'+this.product.id)
                    .then((response) => {
                        this.product = response.data;
                        console.log("Products", this.product);
                    })
            },
        }
    };


</script>
