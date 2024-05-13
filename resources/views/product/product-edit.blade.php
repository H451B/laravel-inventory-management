<x-layouts.master title="Create Product" back="products.index">
    <div class="mx-3 row d-flex justify-content-center">
        <div class="card p-3" style="border-top: 2px solid #007bff;">

            <form action="{{ route('products.update',$product) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <p class="m-0 p-0 fw-bold">Select Product Category:
                            <span style="color:red">*</span>
                        </p>
                        <select aria-label="product-category" name="product_category_id" class="form-select" id="product_category_id">
                            <option>Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" @if($product->product_category_id == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('product_category_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <p class="m-0 p-0 fw-bold">Select Product Type:
                            <span style="color:red">*</span>
                        </p>
                        <select aria-label="product-type" name="product_type_id" class="form-select" id="product_type_id">
                            <option>Select Type</option>
                            @foreach ($types as $type)
                            <option value="{{$type->id}}" @if($product->product_type_id == $type->id) selected @endif>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('product_type_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <p class="m-0 p-0 fw-bold">Sku:
                            <span style="color:red">*</span>
                        </p>
                        <input type="text" name="sku" class="form-control" placeholder="SKU" id="sku" value="{{ $product->sku }}">
                        @error('sku')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-sm-4">
                        <p class="m-0 p-0 fw-bold">Name:
                            <span style="color:red">*</span>
                        </p>
                        <input type="text" name="name" class="form-control" placeholder="Name" id="name" value="{{ $product->name }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <p class="m-0 p-0 fw-bold">Description:</p>
                        <textarea name="description" class="form-control" placeholder="Description" id="description">{{ $product->description }}</textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <p class="m-0 p-0 fw-bold">Quantity:</p>
                        <input type="number" name="qty" class="form-control" placeholder="Quantity" id="qty" value="{{ $product->qty }}">
                        @error('qty')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <p class="m-0 p-0 fw-bold">Unit Purchase Price:</p>
                        <input type="number" name="unit_purchase_price" class="form-control" placeholder="Unit Purchase Price" id="unit_purchase_price" value="{{ $product->unit_purchase_price }}">
                        @error('unit_purchase_price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <p class="m-0 p-0 fw-bold">Unit Selling Price:</p>
                        <input type="number" name="unit_selling_price" class="form-control" placeholder="Unit Selling Price" id="unit_selling_price" value="{{ $product->unit_selling_price }}">
                        @error('unit_selling_price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-sm-6">
                        <p class="m-0 p-0 fw-bold">Expiry Date:</p>
                        <input type="date" name="expiry_date" class="form-control" id="expiry_date" value="{{ $product->expiry_date }}">
                        @error('expiry_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <p class="m-0 p-0 fw-bold">Images:</p>
                        <input type="file" name="images[]" class="form-control" placeholder="New Images" id="imagesInput" multiple>
                        <br>
                        <div id="imagesPreview">
                            @foreach ($product->images as $image)
                            <img src="{{ asset($image->image_path) }}" alt="Product Image" style="max-width: 100px; margin-right: 10px;">
                            @endforeach
                        </div>
                        @error('images')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-end">Submit</button>
            </form>

        </div>
    </div>

    <!-- {{-- <script>
        document.getElementById('photoInput').addEventListener('change', function(event) {
            displayImagePreview(event.target.files[0], 'photoPreview');
        });
    
        document.getElementById('nidPictureInput').addEventListener('change', function(event) {
            displayImagePreview(event.target.files[0], 'nidPicturePreview');
        });
    
        function displayImagePreview(file, previewId) {
            var imageType = /^image\//;
    
            if (!file || !imageType.test(file.type)) {
                return;
            }
    
            var reader = new FileReader();
            reader.onload = function(event) {
                var img = document.createElement('img');
                img.src = event.target.result;
                img.style.maxWidth = '100%'; // Adjust image width if needed
                var previewDiv = document.getElementById(previewId);
                previewDiv.innerHTML = '';
                previewDiv.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    </script> --}} -->


</x-layouts.master>