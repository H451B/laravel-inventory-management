<div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Product Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product.categories.update',$category->id) }}" method="post">
                    @method('PUT')
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name:</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter category name" value="{{$category->name}}" required>
                        {{-- @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror --}}
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
