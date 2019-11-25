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
                                    <h2 class="mb-0">Create Category</h2>
                                </div>
                            </div>
                        </div>
                        <form @submit.prevent="createCategory">
                            <div class="card-body">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="category-name">Category Name</label>
                                    <input v-model="category.name" type="text" id="category-name" class="form-control form-control-alternative" placeholder="Enter Name" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="category-description">Description</label>
                                    <textarea v-model="category.description" id="category-description" rows="4" class="form-control form-control-alternative" placeholder="A few words about the product ..."></textarea>
                                </div>
                                <div class="form-group focused">
                                    <label class="form-control-label " for="brand-status">Available</label>
                                    <input type="checkbox" v-model="category.status" id="brand-status">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-block">Add Category</button>
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
    import Swal from "sweetalert2";
    import jQuery from 'jquery';
    export default {
        data() {
            return {
                category: {
                    name: '',
                    description: '',
                    status: true,
                }
            }
        },
        methods: {
            createCategory() {
                axios.post('/api/product-category', this.category)
                    .then((result) => {
                        Swal.fire({
                            title: 'Category Added',
                            icon: 'success',
                            confirmButtonText: "Ok"
                        }).then((value) =>{
                            if(value){
                                this.$router.go(-1);
                            }
                        })
                    }).catch((error) => {
                    alert('error: ' + error.toString());
                });
            },
        }
    }
</script>
