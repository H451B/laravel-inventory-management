<x-layouts.master title="Create Purchase" back="purchases.index">
    <div class="row d-flex justify-content-center p-3 mx-3">

        <form action="{{route('purchases.store')}}" method="post" enctype="multipart/form-data" class="p-3 border border-primary rounded" style="--bs-border-opacity: .5;">
            @csrf

            <div class="card mb-3" style="border-top: 2px solid #007bff;background:whitesmoke">
                <div class="card-header bg-light">
                    <p>Supplier</p>
                </div>
                <div class="card-body row mb-3">
                    <div class="col-sm-6">
                        <select name="supplier_id" id="supplier" class="form-select">
                            <option value="">Select Supplier</option>
                            @forelse ($suppliers as $supplier)
                            <option value="supplier_id">{{ $supplier->name }}</option>
                            @empty
                            <option>NO SUPPLIER</option>
                            @endforelse
                        </select>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6">Date</div>
                </div>
            </div>

            {{-- product details start --}}
            <!-- <div class="card mb-3" id="productForm" style="border-top: 2px solid #007bff;background:whitesmoke">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between">
                        <p>Product</p>
                        <i class="fas fa-plus-circle pe-auto" id="addProduct"> New Product</i>
                    </div>
                </div>
                <div class="card-body row mb-3">
                    <div class="row product-row">
                        <div class="col-sm-5">
                            <select name="products[id][]" class="form-select" id="productSelect">
                                <option>Select Product</option>
                                @forelse($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                                @empty
                                <p>no product available</p>
                                @endforelse
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <input type="number" name="products[qty][]" class="form-control" placeholder="Quantity" id="qty">
                            @error('qty')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-2">
                            <input type="number" name="products[unit_purchase_price][]" class="form-control" placeholder="Unit Purchase Price" id="unit_purchase_price">
                            @error('unit_purchase_price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-1">Expiry:</div>
                        <div class="col-sm-2">
                            <input type="date" name="products[expiry_dates][]" class="form-control" id="expiry_date">
                            @error('expiry_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="card mb-3" id="productForm" style="border-top: 2px solid #007bff;background:whitesmoke">
                <div class="card-header bg-light">
                    <p>Product</p>
                </div>

                <div class="card-body row" id="productContainer">
                    <!-- Initial product row -->
                    <!-- <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-sm-5">Name</th>
                                <th class="col-sm-2">Quantity</th>
                                <th class="col-sm-2">Unit Purchase Price</th>
                                <th class="col-sm-2">Expiry Date</th>
                                <th class="col-sm-1">Action</th>
                            </tr>
                        </thead>
                        <tbody class="row product-row">
                            <td>
                                <select name="products[id][]" class="form-select product-select">
                                    @forelse($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                    @empty
                                    <p>no product available</p>
                                    @endforelse
                                </select>
                            </td>

                            <td>
                                <input type="number" name="products[qty][]" class="form-control" placeholder="Quantity">
                            </td>

                            <td>
                                <input type="number" name="products[unit_purchase_price][]" class="form-control" placeholder="Unit Purchase Price">
                            </td>

                            <td>
                                <input type="date" name="products[expiry_dates][]" class="form-control">
                            </td>

                            <td>
                                <button class="btn btn-danger remove-product">Remove</button>
                            </td>
                        </tbody>
                    </table> -->
                    <div class="row">
                        <p class="col-sm-5 m-0 p-0 text-center">Product Name</p>
                        <p class="col-sm-2 m-0 p-0 text-center">Quantity</p>
                        <p class="col-sm-2 m-0 p-0 text-center">Unit Purchase Price</p>
                        <p class="col-sm-2 m-0 p-0 text-center">Expiry Date</p>
                        <p class="col-sm-1 m-0 p-0 text-center">Remove</p>
                    </div>
                    <hr>
                    <div class="row product-row mb-2">
                        <div class="col-sm-5">
                            <select name="products[id][]" class="form-select product-select">
                                <option value="">Select Product</option>
                                @forelse($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                                @empty
                                <p>no product available</p>
                                @endforelse
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <input type="number" name="products[qty][]" class="form-control" placeholder="Quantity">
                        </div>

                        <div class="col-sm-2">
                            <input type="number" name="products[unit_purchase_price][]" class="form-control" placeholder="Unit Purchase Price">
                        </div>

                        <div class="col-sm-2">
                            <input type="date" name="products[expiry_dates][]" class="form-control">
                        </div>

                        <div class="col-sm-1">
                            <button class="btn btn-danger remove-product">Remove</button>
                        </div>
                    </div>
                    <!-- <div class="d-flex justify-content-center"><i class="fas fa-plus-circle pe-auto" id="addProduct"> New Product</i></div> -->
                </div>

                <!-- Add new product btn-->
                <div class="d-flex justify-content-center mb-2"><i class="fas fa-plus-circle pe-auto text-danger" id="addProduct"> New Product</i></div>

                <div class="card-footer row">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4">
                        <p class="mb-0">Total:</p>
                        <p class="mb-0">Discount:</p>
                        <p class="mb-0">Sub Total:</p>
                    </div>
                </div>
            </div>
            {{-- product details ends --}}

            {{-- Payment --}}
            <div class="card mb-3" style="border-top: 2px solid #007bff;background:whitesmoke">
                <div class="card-header">
                    <p>Payment</p>
                </div>
                <div class="card-body row mb-3">
                    <div class="">Payment:</div>
                </div>
            </div>
            {{-- Payment ends --}}

            <button type="submit" class="btn btn-primary float-end">Submit</button>
        </form>


    </div>

    <script src="{{ asset('ui/backend/dist/js/select2.min.js') }}" defer></script>
    <script>
        // $(document).ready(function() {
        //     // Hide the initial product row
        //     $('.product-row').hide();

        //     // Click event for adding new product row
        //     $('#addProduct').click(function() {
        //         // Clone the initial product row
        //         var productRow = $('.product-row').first().clone();

        //         // Clear input values
        //         productRow.find('select.product-select').val('');
        //         productRow.find('input[type="number"], input[type="date"]').val('');

        //         // Show the cloned product row
        //         productRow.appendTo('#productContainer').fadeIn();

        //         // Initialize Select2 for the new select element
        //         productRow.find('select.product-select').select2({
        //             placeholder: "Select Product",
        //             allowClear: true
        //         });
        //     });
        //     // Click event for removing product row
        //     $('#productContainer').on('click', '.remove-product', function() {
        //         // Remove the parent product row when remove button is clicked
        //         $(this).closest('.product-row').remove();
        //     });
        // });
        $(document).ready(function() {
            // Hide the initial product row
            $('.product-row').hide();

            // Click event for adding new product row
            $('#addProduct').click(function() {
                // Clone the initial product row
                var productRow = $('.product-row').first().clone();

                // Clear input values
                productRow.find('select.product-select').val('');
                productRow.find('input[type="number"], input[type="date"]').val('');

                // Remove the already selected option from subsequent select dropdowns
                var selectedIds = [];
                $('#productContainer select.product-select').each(function() {
                    var selectedId = $(this).val();
                    if (selectedId !== '') {
                        selectedIds.push(selectedId);
                    }
                });
                productRow.find('select.product-select option').each(function() {
                    var optionValue = $(this).val();
                    if ($.inArray(optionValue, selectedIds) !== -1) {
                        $(this).remove();
                    }
                });

                // Show the cloned product row
                productRow.appendTo('#productContainer').fadeIn();

                // Initialize Select2 for the new select element
                productRow.find('select.product-select').select2({
                    placeholder: "Select Product",
                    allowClear: true
                });

                // Show remove button for the cloned product row
                productRow.find('.remove-product').show();
            });

            // Click event for removing product row
            $('#productContainer').on('click', '.remove-product', function() {
                // Remove the parent product row when remove button is clicked
                $(this).closest('.product-row').remove();
            });
        });
    </script>

</x-layouts.master>