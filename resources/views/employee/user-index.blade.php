<x-layouts.master title="Employee">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Employees</h3>
                        @can('user-create')
                            <a class="btn btn-light" href="{{ route('users.create') }}">
                                Create Employee
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
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr style="max-height: 130px">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="badge rounded-pill text-bg-success">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            @if ($user->name != 'Super Admin')
                                                <a href="{{ route('users.show', $user->id) }}"
                                                    class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                                @can('user-edit')
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i>
                                                        Edit</a>
                                                @endcan

                                                @can('user-delete')
                                                    @if ($user->name != Auth::user()->hasRole($user->name))
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Do you want to delete this role?');"><i
                                                                class="fas fa-trash-alt"></i></button>
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
