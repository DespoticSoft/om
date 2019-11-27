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
