@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Button Visibility Master</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.button-visibility.store') }}" class="mb-4">
        @csrf
        <div class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status_id" class="form-select" required>
                    <option value="">Select Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->display_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Role</label>
                <select name="role_id" class="form-select" required>
                    <option value="">Select Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Button</label>
                <select name="button_type" class="form-select" required>
                    <option value="">Select Button</option>
                    @foreach($buttonTypes as $type)
                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Add Rule</button>
            </div>
        </div>
    </form>

    <h5 class="mb-3">Current Button Visibility Rules</h5>
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Button</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rules as $rule)
                <tr>
                    <td>{{ $rule->status->display_name ?? '-' }}</td>
                    <td>{{ ucfirst($rule->role->name ?? '-') }}</td>
                    <td><span class="badge bg-secondary">{{ ucfirst($rule->button_type) }}</span></td>
                    <td>
                        <form method="POST" action="{{ route('admin.button-visibility.destroy', $rule) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this rule?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-muted">No rules set yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 