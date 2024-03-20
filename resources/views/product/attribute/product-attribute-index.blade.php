<x-layouts.master title="Product Attributes">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header bg-primary">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Product Category</h3>
                        @can('product-category-create')
                            <a class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                                Create Category
                            </a>
                            <!-- create modal -->
                            @include('product.attribute.product-category-create')
                            <!-- end create -->
                        @endcan
                    </div>

                </div>

                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productCategories as $category)
                                <tr style="max-height: 130px">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td class="d-flex justify-content-around">
                                        @can('product-categroy-edit')
                                            <a class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#editCategoryModal{{ $category->id }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- edit modal -->
                                            @include('product.attribute.product-category-edit', [
                                                'category' => $category,
                                            ])
                                            <!-- end edit -->
                                        @endcan

                                        @can('product-category-delete')
                                            <form action="{{ route('product.categories.destroy', $category->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Do you want to delete this Category?');">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <span class="text-danger">
                                            <strong>No Category Found!</strong>
                                        </span>
                                    </td>
                                </tr>
                            @endforelse

                            <tr>
                                <td colspan="3">
                                    {{ $productCategories->links() }}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-primary">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Product Type</h3>
                        @can('product-type-create')
                            <a class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createTypeModal">
                                Create Type
                            </a>
                            <!-- create modal -->
                            @include('product.attribute.product-type-create')
                            <!-- end create -->
                        @endcan
                    </div>

                </div>

                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productTypes as $type)
                                <tr style="max-height: 130px">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $type->name }}</td>
                                    <td>{{ $type->category->name }}</td>
                                    <td class="d-flex justify-content-around">
                                        @can('product-type-edit')
                                            <a class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#editTypeModal{{ $type->id }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- edit modal -->
                                            @include('product.attribute.product-type-edit', [
                                                'type' => $type,
                                            ])
                                            <!-- end edit -->
                                        @endcan

                                        @can('product-type-delete')
                                            <form action="{{ route('product.types.destroy', $type->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Do you want to delete this type?');"><i
                                                        class="bi bi-trash"></i> Delete</button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                                {{ $productTypes->links() }}
                            @empty
                                <td colspan="3">
                                    <span class="text-danger">
                                        <strong>No Role Found!</strong>
                                    </span>
                                </td>
                            @endforelse

                            <tr>
                                <td colspan="3">
                                    {{ $productCategories->links() }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-layouts.master>
