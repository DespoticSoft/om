<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="modal fade" id="brand-create" tabindex="-1" role="dialog" aria-labelledby="brand-createLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="card shadow text-left">
                                    <div class="card-header bg-transparent">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="text-uppercase text-muted ls-1 mb-1">Store</h6>
                                                <h2 class="mb-0">Create Brand</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <form @submit.prevent="createBrand">
                                        <div class="card-body">
                                            <div class="form-group focused">
                                                <label class="form-control-label " for="brand-name">Brand Name</label>
                                                <input v-model="brand.name" type="text" id="brand-name" class="form-control form-control-alternative" placeholder="Enter Brand Name">
                                            </div>
                                            <div class="form-group focused">
                                                <label class="form-control-label " for="brand-status">Available</label>
                                                <input type="checkbox" v-model="brand.status" id="brand-status">
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success btn-block">Add Brand</button>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <button id="product-create-close" type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
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
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data (){
            return {
                brand: {
                    name: '',
                    status: true
                }
            }
        },
        methods: {
            createBrand(){
                axios.post('/api/brand', this.brand)
                    .catch((error) =>{
                    alert('error: '+ error.toString());
                });
            }
        }
    }
</script>
