<x-layouts.master title="Update User" back="users.index">
    <div class="row d-flex justify-content-center">
        <div class="card col-sm-10 p-3">

            <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            
                <!-- Name -->
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Name: </div>
                    <div class="col-sm-9">
                        <input style="background: whitesmoke" type="text" name="name" class="form-control"
                            placeholder="Full Name" id="name" value="{{ $user->name }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <!-- NID Number -->
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">NID Number: </div>
                    <div class="col-sm-9">
                        <input style="background: whitesmoke" type="text" name="nid_number" class="form-control"
                            placeholder="NID Number" id="nid_number" value="{{ $user->nid_number }}">
                        @error('nid_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- NID Scanned Photo -->
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">NID Scanned Photo: </div>
                    <div class="col-sm-5">
                        <input style="background: whitesmoke" type="file" name="nid_picture" class="form-control"
                            placeholder="NID Scanned Photo" id="nidPictureInput">
                        @error('nid_picture')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        @if ($user->nid_picture)
                            <img src="{{ asset('storage/user_nid_photo/' . $user->nid_picture) }}" alt="NID picture" class="img-fluid">
                        @endif
                    </div>
                </div>
                
                <!-- Phone -->
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Phone: </div>
                    <div class="col-sm-9">
                        <input style="background: whitesmoke" type="text" name="phone" class="form-control"
                            placeholder="Phone" id="phone" value="{{ $user->phone }}">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Email -->
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Email: </div>
                    <div class="col-sm-9">
                        <input style="background: whitesmoke" type="email" name="email" class="form-control"
                            placeholder="Email" id="email" value="{{ $user->email }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Password -->
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Password: </div>
                    <div class="col-sm-9">
                        <input style="background: whitesmoke" type="password" name="password" class="form-control"
                            placeholder="Password" id="password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <!-- Confirm Password -->
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Confirm Password: </div>
                    <div class="col-sm-9">
                        <input style="background: whitesmoke" id="password_confirmation" class="form-control"
                            type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                        @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <!-- Roles -->
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Roles: </div>
                    <div class="col-sm-9">
                        <div class=" shadow-sm p-3 mb-5 bg-body-tertiary rounded" style="max-height: 150px">
                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}" @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif>
                                    <label class="form-check-label" for="role_{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('roles')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <!-- Image -->
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Image: </div>
                    <div class="col-sm-5">
                        <input style="background: whitesmoke" type="file" name="photo" class="form-control" placeholder="New Role" id="photoInput">
                        @error('photo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        @if ($user->photo)
                            <img src="{{ asset('storage/user_photo/' . $user->photo) }}" alt="NID picture" class="img-fluid">
                        @endif
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary float-end">Submit</button>
            </form>
            
        </div>
    </div>
    
</x-layouts.master>
