<x-layouts.master title="Role">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Roles</h3>
                        @can('role-create')
                        <a class="btn btn-light" href="{{ route('roles.create') }}">
                            Create Role
                        </a>
                        @endcan
                    </div>

                </div>

                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Role</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)

                                <tr style="max-height: 130px">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @if ($role->name == 'Super Admin')
                                            <span class="badge rounded-pill text-bg-primary">all</span>
                                        @else
                                        @foreach($role->permissions as $permission)
                                        <span class="badge rounded-pill text-bg-primary">{{$permission->name}}</span>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            {{-- <a href="{{ route('roles.show', $role->id) }}"
                                                class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a> --}}

                                            @if ($role->name != 'Super Admin')
                                                @can('role-edit')
                                                    <a href="{{ route('roles.edit', $role->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i>
                                                        Edit</a>
                                                @endcan

                                                @can('role-delete')
                                                    @if ($role->name != Auth::user()->hasRole($role->name))
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Do you want to delete this role?');"><i
                                                                class="bi bi-trash"></i> Delete</button>
                                                    @endif
                                                @endcan
                                            @endif

                                        </form>
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
