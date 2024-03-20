<x-layouts.master title="Create Supplier" back="suppliers.index">
    <div class="row d-flex justify-content-center">
        <div class="card col-sm-10 p-0">
            <div class="card-header bg-primary">
                <h3 class="card-title">Create Supplier</h3>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('suppliers.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-sm-3">Name: </div>
                        <div class="col-sm-9">
                            <input style="background: whitesmoke" type="text" name="name" class="form-control"
                                placeholder="Full Name" id="name">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">Phone 1: </div>
                        <div class="col-sm-9">
                            <input style="background: whitesmoke" type="text" name="phone1" class="form-control"
                                placeholder="Phone 1" id="phone1">
                            @error('phone1')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">Phone 2 (optional): </div>
                        <div class="col-sm-9">
                            <input style="background: whitesmoke" type="text" name="phone2" class="form-control"
                                placeholder="Phone 2" id="phone2">
                            @error('phone2')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">Email: </div>
                        <div class="col-sm-9">
                            <input style="background: whitesmoke" type="email" name="email" class="form-control"
                                placeholder="Email" id="email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">Address: </div>
                        <div class="col-sm-9">
                            <input style="background: whitesmoke" type="text" name="address" class="form-control"
                                placeholder="Address" id="address">
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                </form>
            </div>
        </div>
    </div>
    
</x-layouts.master>
