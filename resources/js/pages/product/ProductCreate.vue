<template>
    <div>
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Store</h6>
                                <h2 class="mb-0">Create Product</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group text-center">
                                    <img style="width:100px;" src="https://images.vexels.com/media/users/3/158122/isolated/preview/39e6da6d7ac6e177c43e50a97eb9de4d-qr-code-sticker-by-vexels.png" class="rounded-circle">
                            </div>
                            <div class="form-group focused">
                                <label class="form-control-label" for="name">Name</label>
                                <input type="text" id="name" class="form-control form-control-alternative" placeholder="Enter Name" value="">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="image">Image</label>
                                <input class="dropify" type="file" name="image" id="image" placeholder="Image">
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="category">Category</label>
                                <select name="category" id="category" class="form-control form-control-alternative">
                                    <option value="3">1</option>
                                    <option value="3">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="description">Description</label>
                                <textarea name="description" id="description" rows="4" class="form-control form-control-alternative" placeholder="A few words about you ...">A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Add Product</button>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import "dropify";
    export default {};
</script>
