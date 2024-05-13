<x-layouts.master title="Product">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Product</h3>
                        @can('product-create')
                        <a class="btn btn-light" href="{{ route('products.create') }}">
                            Create Product
                        </a>
                        @endcan
                    </div>

                </div>

                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>sku</th>
                                <th>Status</th>
                                <th>Quantity</th>
                                <th>Purchase Price</th>
                                <th>Sell Price</th>
                                <th>Discount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr style="max-height: 130px">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->status }}</td>
                                <td>{{ $product->qty }}</td>
                                <td>{{ $product->unit_purchase_price }}</td>
                                <td>{{ $product->unit_selling_price }}</td>
                                <td>{{ $product->discount_percentage }}</td>
                                <td>
                                    @can('list-product')
                                    <a href="{{ route('products.show', $product->id) }}"
                                                    class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                                    @endcan

                                    @can('product-edit')

                                    <a href="{{ route('products.edit', $product) }}"
                                                        class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i>
                                                        Edit</a>
                                    @endcan

                                    @can('product-delete')
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this product?');"><i class="bi bi-trash"></i> Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <td colspan="3">
                                <span class="text-danger">
                                    <strong>No Product Found!</strong>
                                </span>
                            </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-layouts.master>