<x-layouts.master title="User Details" back="users.index">
    <div class="card">

        <div class="card-header bg-primary">
            User Details
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <p><strong>Name:</strong></p>
                </div>
                <div class="col-sm-8"> {{ $user->name }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-3">
                    <p><strong>Email:</strong></p>
                </div>
                <div class="col-sm-8"> {{ $user->email }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-3">
                    <p><strong>Phone:</strong></p>
                </div>
                <div class="col-sm-8"> {{ $user->phone }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-3">
                    <p><strong>NID Number:</strong></p>
                </div>
                <div class="col-sm-8"> {{ $user->nid_number }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-3">
                    <p class="fw-bold">Roles:</p>
                </div>
                <div class="col-sm-8">
                    <ul>
                        @foreach ($user->roles as $role)
                            <li>{{ $role->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-3">
                    <p><strong>Nid Picture:</strong></p>
                </div>
                <div class="col-sm-8">
                    @if ($user->nid_picture)
                        <img src="{{ asset('storage/user_nid_photo/' . $user->nid_picture) }}" alt="Scanned NID Image"
                            width="300px">
                    @else
                        <p>No email image available</p>
                    @endif
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-3">
                    <p><strong>Photo:</strong></p>
                </div>
                <div class="col-sm-8">
                    @if ($user->photo)
                        <img src="{{ asset('storage/user_photo/' . $user->photo) }}" alt="Photo" width="300px">
                    @else
                        <p>No another image available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-layouts.master>
