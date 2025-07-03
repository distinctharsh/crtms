@extends('layouts.app')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Users', 'url' => route('users.index')],
    ];
@endphp

    @include('layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])

<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>User Management</h2>
                @if(auth()->user()->isManager())
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                    <i class="bi bi-plus-lg"></i> Add User
                </button>
                @endif
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="">
                <table id="usersTable" class="table table-hover w-100">
                    <thead class="table-light">
                        <tr>
                            <th>S.No.</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Verticals</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr @if($user->deleted_at) style="background:#f8d7da;" @endif>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                <span class="badge 
                                    @switch($user->role->slug ?? '')
                                        @case('admin') bg-danger @break
                                        @case('manager') bg-primary @break
                                        @case('vm') bg-info @break
                                        @case('nfo') bg-warning text-dark @break
                                        @default bg-secondary
                                    @endswitch
                                ">
                                    {{ $user->role->name ?? 'No Role' }}
                                </span>
                            </td>
                            <td>
                                @if($user->verticals && $user->verticals->count())
                                    {{ $user->verticals->pluck('name')->implode(', ') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                @if($user->deleted_at)
                                    <span class="badge bg-danger">Deleted</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    @if($user->deleted_at)
                                        <form action="{{ route('users.restore', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button class="btn btn-success btn-sm" type="submit" title="Restore"><i class="bi bi-arrow-counterclockwise"></i></button>
                                        </form>
                                    @else
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm mr-5"><i class="fas fa-pen"></i></a>
                                        @if($user->id !== auth()->user()->id && $user->role->slug !== 'manager')
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" style="margin-left: 4px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fas fa-trash"></i></button>
                                        </form>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No users found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- DataTables handles pagination/info -->
        </div>
    </div>
</div>

@if(auth()->user()->isManager())
<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('users.store') }}" id="createUserForm">
          @csrf
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required autofocus maxlength="50">
            @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}" required maxlength="60">
            @error('full_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$" title="Password must be at least 6 characters, contain one uppercase letter, one lowercase letter, one digit, and one special character (!@#$%^&*).">
            <small class="form-text text-muted">Password must be at least 6 characters, contain one uppercase letter, one lowercase letter, one digit, and one special character (!@#$%^&*).</small>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
          </div>
          <div class="mb-3">
            <label for="role_id" class="form-label">Role</label>
            <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required
                onchange="document.getElementById('verticalBox').style.display = (this.options[this.selectedIndex].text.toLowerCase().includes('vm') || this.options[this.selectedIndex].text.toLowerCase().includes('nfo')) ? 'block' : 'none';">
              <option value="">Select a role</option>
              @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
              @endforeach
            </select>
            @error('role_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3" id="verticalBox"
            style="display: {{ (old('role_id') && (App\Models\Role::find(old('role_id'))->slug == 'vm' || App\Models\Role::find(old('role_id'))->slug == 'nfo')) ? 'block' : 'none' }};">
            <label for="vertical_id" class="form-label">Vertical</label>
            <select name="vertical_id" class="form-control">
              <option value="">Select Vertical</option>
              @foreach($verticals as $vertical)
                <option value="{{ $vertical->id }}" {{ old('vertical_id') == $vertical->id ? 'selected' : '' }}>{{ $vertical->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" id="registerSubmitBtn">
              <span id="registerBtnText">Create</span>
              <span id="registerBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
          </div>
        </form>
        @if($errors->any())
        <div class="alert alert-danger mt-3">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endif
@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
<style>
    /* Right-align DataTables pagination */
    div.dataTables_wrapper div.dataTables_paginate {
        text-align: right !important;
        float: right !important;
    }
</style>
@endpush
@push('scripts')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#usersTable').DataTable({
        responsive: true,
        dom: '<"d-flex justify-content-between align-items-center mb-2"Bfl>rtip',
        buttons: [
            {
                extend: 'copy',
                text: '<i class="bi bi-clipboard"></i>',
                className: 'btn btn-light btn-sm me-1',
                titleAttr: 'Copy'
            },
            {
                extend: 'csv',
                text: '<i class="bi bi-filetype-csv"></i>',
                className: 'btn btn-light btn-sm me-1',
                titleAttr: 'Export as CSV'
            },
            {
                extend: 'excel',
                text: '<i class="bi bi-file-earmark-excel"></i>',
                className: 'btn btn-light btn-sm me-1',
                titleAttr: 'Export as Excel'
            },
            {
                extend: 'pdf',
                text: '<i class="bi bi-file-earmark-pdf"></i>',
                className: 'btn btn-light btn-sm me-1',
                titleAttr: 'Export as PDF'
            },
            {
                extend: 'print',
                text: '<i class="bi bi-printer"></i>',
                className: 'btn btn-light btn-sm',
                titleAttr: 'Print'
            }
        ]
    });

    // Password validation for Create User Modal
    $('#createUserForm').on('submit', function(e) {
        var password = $('#password').val();
        var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/;
        if (!pattern.test(password)) {
            alert('Password must be at least 6 characters, contain one uppercase letter, one lowercase letter, one digit, and one special character (!@#$%^&*).');
            $('#password').focus();
            e.preventDefault();
            return false;
        }
    });
});
</script>
@endpush