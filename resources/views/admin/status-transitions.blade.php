@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Status Workflow Management</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.status-transitions.update') }}">
        @csrf
        <div class="mb-3">
            <label for="from_status_id" class="form-label">From Status</label>
            <select name="from_status_id" id="from_status_id" class="form-select" required>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->display_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Allowed Next Statuses</label>
            @foreach($statuses as $status)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="to_status_ids[]" value="{{ $status->id }}" id="to_status_{{ $status->id }}">
                    <label class="form-check-label" for="to_status_{{ $status->id }}">{{ $status->display_name }}</label>
                </div>
            @endforeach
        </div>
        <div class="mb-3">
            <label class="form-label">Allowed Roles for this Transition</label>
            @foreach($roles as $role)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="role_ids[]" value="{{ $role->id }}" id="role_{{ $role->id }}">
                    <label class="form-check-label" for="role_{{ $role->id }}">{{ ucfirst($role->name) }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Save Transitions</button>
    </form>
    <hr>
    <h4>Existing Transitions</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>From Status</th>
                <th>To Status</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transitions as $transition)
                <tr>
                    <td>{{ $transition->fromStatus->display_name }}</td>
                    <td>{{ $transition->toStatus->display_name }}</td>
                    <td>{{ ucfirst($transition->role->name) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 