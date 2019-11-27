<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Categories</h3>
                            </div>
                            <div class="col text-right">
                                <router-link :to="{name: 'category-create'}" class="btn btn-outline-success"><i class="fa fa-plus"></i> Add Category</router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                       <div class="row justify-content-center">
                           <div class="col">
                               <table class="table table-hover table-striped table-bordered">
                                   <thead class="thead-dark">
                                   <tr>
                                       <th>
                                           #
                                       </th>
                                       <th>
                                           Parent
                                       </th>
                                       <th>
                                           Name
                                       </th>
                                       <th>
                                           Description
                                       </th>
                                       <th>
                                           status
                                       </th>
                                       <th>
                                           Updated By
                                       </th>
                                       <th>
                                           Updated at
                                       </th>
                                       <th>
                                           Action
                                       </th>
                                   </tr>
                                   </thead>
                                   <tbody class="text-center">
                                   <tr v-for="category in categories">
                                       <td>
                                           {{ categories.indexOf(category)+1 }}
                                       </td>
                                       <td>
                                           <span v-if="category.parent">{{ category.parent }}</span>
                                           <span v-else>-</span>
                                       </td>
                                       <td class="text-left">
                                           {{ category.name }}
                                       </td>
                                       <td>
                                           {{ category.description }}
                                       </td>
                                       <td>
                                           <i :class="category.status ? 'fa fa-check-circle text-success': 'fa fa-ban text-danger'"></i>
                                       </td>
                                       <td>
                                           {{ category.updated_by }}
                                       </td>
                                       <td>
                                           {{ category.updated_at}}
                                       </td>
                                       <td>
                                           <a href="" class="btn btn-sm btn-info"><i class="fa fa-pencil-alt"></i></a>
                                           <button @click="deleteFunc(category)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                       </td>
                                   </tr>
                                   </tbody>
                               </table>
                           </div>
                       </div>
<!--                        <v-data-table-->
<!--                            :headers="headers"-->
<!--                            :items="categories"-->
<!--                            :items-per-page="5"-->
<!--                            class="elevation-1"-->
<!--                            loading loading-text="Loading.. Please wait"-->
<!--                        >-->
<!--                        </v-data-table>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';
    import axios from 'axios';
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
            },
            deleteFunc(category){
                const swalWithBootsrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });
                swalWithBootsrapButtons.fire({
                    title: 'Delete ',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Delete!',
                    cancelButtonText: 'Cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if(result.value){
                        axios.delete('/api/product-category/'+category.id)
                            .then((response) =>{
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'warning',
                                    title: 'Category has been deleted!',
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                this.getCategory();
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

        }
    }
</script>
