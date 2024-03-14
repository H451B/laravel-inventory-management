<x-layouts.master title="Edit Role" back="roles.index">
    <div class="row d-flex justify-content-center">
        <div class="card col-sm-10 p-3">
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <form action="{{ route('roles.update', $role->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-sm-3">Role: </div>
                    <div class="col-sm-9">
                        <input style="background: whitesmoke" type="text" name="name" id="name"
                            class="form-control" value="{{ $role->name }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <p class="m-0"><strong>Granted Permissions</strong></p>
                        @foreach ($groupedPermissions as $type => $permissions)
                        <div class="col-sm-2 shadow-sm m-3 p-3 bg-body-tertiary rounded">
                                <p><strong>{{ ucfirst($type) }}:</strong></p>
                                @foreach ($permissions as $permission)
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                        {{ in_array($permission->id, $rolePermissions ?? []) ? 'checked' : '' }}>
                                    {{ $permission->name }}<br>
                                @endforeach
                            </div>
                            @endforeach
                            @error('permissions')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-end">Update</button>
            </form>
        </div>
    </div>
</x-layouts.master>
