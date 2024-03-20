
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
                    {{-- <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($suppliers as $supplier)
                                <tr style="max-height: 130px">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->phone1 }} <br> {{ $supplier->phone2 ?: null }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>


                                        @can('supplier-edit')
                                            <a class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $supplier->id }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- edit modal -->
                                            @include('supplier.supplier-edit')
                                            <!-- end edit -->
                                        @endcan

                                        @can('supplier-delete')
                                            <form action="{{ route('products.destroy', $supplier->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Do you want to delete this supplier?');"><i
                                                        class="bi bi-trash"></i> Delete</button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @empty
                                <td colspan="3">
                                    <span class="text-danger">
                                        <strong>No Role Found!</strong>
                                    </span>
                                </td>
                            @endforelse
                        </tbody>
                    </table> --}}
                </div>
            </div>
        </div>
    </div>

</x-layouts.master>
