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
                                    <h2 class="mb-0">Create Product</h2>
                                </div>
                            </div>
                        </div>
                        <form @submit.prevent="addProduct">
                            <div class="card-body">
                                <div class="form-group focused">
                                    <label class="form-control-label " for="product-name">Product Name</label>
                                    <input v-model="product.name" type="text" id="product-name" class="form-control form-control-alternative" placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="product-image">Image</label><br>
                                    <img v-if="product.image" style="width:100px;" :src="product.image" class="img-thumbnail" alt="Upload Image"><br>
                                    <input type="file" accept="image/*" id="product-image" @change="imageUpload">
    <!--                                <vue-dropify-->
    <!--                                    @upload="imageUpload"-->
    <!--                                    accept="Image/*"-->
    <!--                                    id="image"-->
    <!--                                    uploadIcon="fa fa-upload"-->
    <!--                                ></vue-dropify>-->
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="category">
                                        Category
                                        <router-link :to="{name: 'category-create'}"><i class="btn btn-sm btn-success fa fa-plus"  data-toggle="modal" data-target="#category-create"></i></router-link>
                                    </label>
                                    <select v-model="product.category_id" id="category" class="form-control form-control-alternative">
                                        <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="description">Description</label>
                                    <textarea v-model="product.description" id="description" rows="4" class="form-control form-control-alternative" placeholder="A few words about the product ..."></textarea>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-block">Add <span v-if="bulk">More</span> Product</button>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <button @click="$router.go(-1)" type="button" class="btn btn-default btn-block">Back</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <BrandCreate/>
    </div>
</template>

<script>
    import VueDropify from 'vue-dropify';
    import axios from 'axios';
    import "dropify";
    import Swal from "sweetalert2";
    import BrandCreate from "./BrandCreate";
    import CategoryCreate from "../category/CategoryCreate";
    export default {
        data: () => {
            return {
                product: {
                    name: '',
                    image: [],
                    qr: 'https://images.vexels.com/media/users/3/158122/isolated/preview/39e6da6d7ac6e177c43e50a97eb9de4d-qr-code-sticker-by-vexels.png',
                    description: '',
                    category_id: '',
                },
                brands: [],
                categories: [],
                category: {
                    name: '',
                    type: '',
                    description: ''
                },
                suppliers: [],
                supplier: [],
                store: [],
                bulk: false
            }
        },
        created: function(){
            this.getCategory();
            if(this.$route.query.bulk){
                this.bulk = true;
            }
        },
        components: {
            'vue-dropify': VueDropify,
            'BrandCreate': BrandCreate,
            'CategoryCreate': CategoryCreate
        },
        methods: {
            getBrands(){
                axios.get('api/brand')
                    .then((result) =>{
                        this.brands = result.data;
                        console.log('Brands Fetched', this.brands);
                });
            },
            getCategory(){
                axios.get('api/product-category')
                    .then((result) => {
                        this.categories = result.data;
                    }).catch((error) => {
                    alert(error);
                });
            },
            getSupplier(){
                axios.get('api/search/user/role/supplier')
                    .then((response) => {
                        this.suppliers = response.data;
                    }).catch((error) => {
                        // alert('error');
                })
            },
            addProduct(){
                axios.post('/api/product', this.product)
                    .then((response) => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Product has been Added!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        if(!this.bulk){
                            this.$router.go(-1);
                        }
                    }).catch((error) =>{
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: error.toString(),
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });
                console.log("Product", this.product);
            },
            imageUpload(e){
                const image = e.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    this.product.image = e.target.result;
                };
            }
        }
    };


</script>
