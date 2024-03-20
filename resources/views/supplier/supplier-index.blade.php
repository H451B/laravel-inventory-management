<x-layouts.master title="Supplier">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Supplier</h3>
                        @can('supplier-create')
                            <a class="btn btn-light" href="{{ route('suppliers.create') }}">
                                Create Supplier
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
                                    <td class="d-flex justify-content-around">
                                        @can('supplier-edit')
                                            <a class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $supplier->id }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- edit modal -->
                                            @include('supplier.supplier-edit')
                                            <!-- end edit -->
                                        @endcan

                                        @can('supplier-delete')
                                            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Do you want to delete this supplier?');"><i
                                                        class="fas fa-trash-alt"></i></button>
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
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-layouts.master>
