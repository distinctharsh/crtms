@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Role-Status Management</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        @foreach($roles as $role)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ ucfirst($role->name) }}</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.role-status.update', $role) }}">
                            @csrf
                            <div class="mb-3">
                                @foreach($allStatuses as $status)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="status_ids[]" value="{{ $status->id }}" id="status-{{ $role->id }}-{{ $status->id }}"
                                            {{ $role->statuses->contains($status->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status-{{ $role->id }}-{{ $status->id }}">
                                            {{ $status->display_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 