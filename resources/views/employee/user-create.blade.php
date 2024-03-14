<x-layouts.master title="Create User" back="users.index">
    <div class="row d-flex justify-content-center">
        <div class="card col-sm-10 p-3">

            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
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
                    <div class="col-sm-3">NID Number: </div>
                    <div class="col-sm-9">
                        <input style="background: whitesmoke" type="text" name="nid_number" class="form-control"
                            placeholder="NID Number" id="nid_number">
                        @error('nid_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">NID Scanned Photo: </div>
                    <div class="col-sm-5">
                        <input style="background: whitesmoke" type="file" name="nid_picture" class="form-control"
                            placeholder="NID Scanned Photo" id="nidPictureInput">
                        @error('nid_picture')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <div id="nidPicturePreview" style="margin-top: 10px;"></div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">Phone: </div>
                    <div class="col-sm-9">
                        <input style="background: whitesmoke" type="text" name="phone" class="form-control"
                            placeholder="Phone" id="phone">
                        @error('phone')
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
                    <div class="col-sm-3">Password: </div>
                    <div class="col-sm-9">
                        <input style="background: whitesmoke" type="password" name="password" class="form-control"
                            placeholder="Password" id="password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3">Confirm Password: </div>
                    <div class="col-sm-9">
                        {{-- <label for="password_confirmation" :value="__('Confirm Password')"></label> --}}
                        <input style="background: whitesmoke" id="password_confirmation" class="form-control"
                            type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                        @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3">Roles: </div>
                    <div class="col-sm-9">
                        <div class=" shadow-sm p-3 mb-5 bg-body-tertiary rounded" style="max-height: 150px">
                            @foreach($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}" @if(in_array($role->id, old('roles', []))) checked @endif>
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

                <div class="row mb-3">
                    <div class="col-sm-3">Image: </div>
                    <div class="col-sm-5">
                        <input style="background: whitesmoke" type="file" name="photo" class="form-control"
                            placeholder="New Role" id="photoInput">
                        @error('photo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <div id="photoPreview" style="margin-top: 10px;"></div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-end">Submit</button>
            </form>
            
        </div>
    </div>

    <script>
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
    </script>
    
    
</x-layouts.master>
