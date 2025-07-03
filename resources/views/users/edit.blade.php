@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Edit User: {{ $user->full_name }}</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                               id="username" name="username" value="{{ old('username', $user->username) }}" required autofocus>
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Full Name -->
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                               id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}" required>
                        @error('full_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password (leave blank to keep current)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password"
                               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$"
                               title="Password must be at least 6 characters, contain one uppercase letter, one lowercase letter, one digit, and one special character (!@#$%^&*).">
                        <small class="form-text text-muted">Password must be at least 6 characters, contain one uppercase letter, one lowercase letter, one digit, and one special character (!@#$%^&*).</small>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control"
                               id="password_confirmation" name="password_confirmation">
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select class="form-select @error('role_id') is-invalid @enderror"
                                id="role_id" name="role_id" required
                                {{ $user->id === auth()->user()->id ? 'disabled' : '' }}>
                            <option value="">Select a role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                        data-slug="{{ $role->slug }}"
                                        {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($user->id === auth()->user()->id)
                            <div class="form-text">You cannot change your own role.</div>
                        @endif
                    </div>

                    <!-- Verticals -->
                    <div class="mb-3" id="verticalBox" style="display: none;">
                        <label for="vertical_ids" class="form-label">Verticals</label>
                        <select name="vertical_ids[]" id="vertical_ids" class="form-control" multiple>
                            @foreach($verticals as $vertical)
                                <option value="{{ $vertical->id }}" {{ collect(old('vertical_ids', $user->verticals->pluck('id')->toArray()))->contains($vertical->id) ? 'selected' : '' }}>
                                    {{ $vertical->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            Update User
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('users.index') }}" class="text-decoration-none">Back to Users</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">User Information</h5>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Created At</dt>
                    <dd class="col-sm-8">{{ $user->created_at->format('M d, Y H:i') }}</dd>

                    <dt class="col-sm-4">Last Updated</dt>
                    <dd class="col-sm-8">{{ $user->updated_at->format('M d, Y H:i') }}</dd>

                    <dt class="col-sm-4">Total Tickets</dt>
                    <dd class="col-sm-8">{{ $user->complaints->count() }}</dd>

                    <dt class="col-sm-4">Assigned Tasks</dt>
                    <dd class="col-sm-8">{{ $user->assignedComplaints->count() }}</dd>
                </dl>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Role Information</h5>
            </div>
            <div class="card-body">

            <h6>Manager Role</h6>
                <ul class="list-unstyled mb-4">
                    <li>• Full access to all tickets</li>
                    <li>• Can manage user accounts</li>
                    <li>• Can assign tickets to users</li>
                    <li>• Can update ticket status</li>
                </ul>


                <h6>User Role</h6>
                <ul class="list-unstyled mb-0">
                    <li>• Can create and manage their own tickets</li>
                    <li>• Cannot access user management</li>
                </ul>

               
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role_id');
        const verticalBox = document.getElementById('verticalBox');

        function toggleVerticalBox() {
            const selectedOption = roleSelect.options[roleSelect.selectedIndex];
            const slug = selectedOption.getAttribute('data-slug');
            if (slug === 'vm' || slug === 'nfo') {
                verticalBox.style.display = 'block';
            } else {
                verticalBox.style.display = 'none';
            }
        }

        if (roleSelect) {
            toggleVerticalBox(); // Run on load
            roleSelect.addEventListener('change', toggleVerticalBox); // On change
        }
    });
</script>
@endpush
