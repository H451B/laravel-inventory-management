<div class="modal fade" id="createTypeModal" tabindex="-1" aria-labelledby="createTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTypeModalLabel">Create Product Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product.types.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Select Category:</label>
                        <select name="product_category_id" class="form-select" id="product_category_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        {{-- @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror --}}
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Type Name:</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter type name" required>
                        {{-- @error('type_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror --}}
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
