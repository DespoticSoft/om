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
                                    <h2 class="mb-0">Update Product</h2>
                                </div>
                            </div>
                        </div>
                        <form @submit.prevent="updateProduct">
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
                                        <option v-for="category in categories" :value="category.id" :selected="category.id == product.category_id">{{ category.name }}</option>
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
                                            <button type="submit" class="btn btn-success btn-block">Update Product</button>
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
    </div>
</template>

<script>
    import VueDropify from 'vue-dropify';
    import axios from 'axios';
    import "dropify";
    import Swal from "sweetalert2";
    import CategoryCreate from "../category/CategoryCreate";
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
                categories: [],
                category: {
                    name: '',
                    type: '',
                    description: ''
                }
           }
        },
        mounted: function(){
            // alert(JSON.stringify(this.$route.params.id));
            this.product.id = this.$route.params.id;
            this.getProduct();
            this.getCategory();
        },
        created(){
        },
        components: {
            'vue-dropify': VueDropify,
            'CategoryCreate': CategoryCreate
        },
        methods: {
            getProduct(){
                axios.get('/api/product/'+this.product.id)
                    .then((response) => {
                        this.product = response.data;
                        console.log("Products", this.product);
                    })
            },
            getCategory(){
                axios.get('/api/product-category')
                    .then((result) => {
                        this.categories = result.data;
                    }).catch((error) => {
                    alert(error);
                });
            },
            updateProduct(){
                axios.put('/api/product/'+this.product.id, this.product)
                    .then((response) => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Product has been updated!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.go(-1);
                    }).catch((error) =>{
                    Swal.fire(
                        ':(',
                        error.toString(),
                        'error'
                    )
                });
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
