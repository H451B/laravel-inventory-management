<div class="modal fade" id="editModal{{ $supplier->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $supplier->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $supplier->id }}">
                    Edit {{ $supplier->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('suppliers.update', $supplier->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- This is required for Laravel to recognize the update method -->

                    <div class="row mb-3">
                        <div class="col-sm-3">Name:</div>
                        <div class="col-sm-9">
                            <input style="background: whitesmoke" type="text" name="name" class="form-control"
                                placeholder="Full Name" id="name" value="{{ old('name', $supplier->name) }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">Phone 1:</div>
                        <div class="col-sm-9">
                            <input style="background: whitesmoke" type="text" name="phone1" class="form-control"
                                placeholder="Phone 1" id="phone1" value="{{ old('phone1', $supplier->phone1) }}">
                            @error('phone1')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">Phone 2 (optional):</div>
                        <div class="col-sm-9">
                            <input style="background: whitesmoke" type="text" name="phone2" class="form-control"
                                placeholder="Phone 2" id="phone2" value="{{ old('phone2', $supplier->phone2) }}">
                            @error('phone2')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">Email:</div>
                        <div class="col-sm-9">
                            <input style="background: whitesmoke" type="email" name="email" class="form-control"
                                placeholder="Email" id="email" value="{{ old('email', $supplier->email) }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">Address:</div>
                        <div class="col-sm-9">
                            <input style="background: whitesmoke" type="text" name="address" class="form-control"
                                placeholder="Address" id="address" value="{{ old('address', $supplier->address) }}">
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-end">Update</button>
                </form>

            </div>
        </div>
    </div>
</div>
