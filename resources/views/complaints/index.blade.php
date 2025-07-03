@extends('layouts.app')

@section('content')
@php
$breadcrumbs = [
['label' => 'Dashboard', 'url' => route('dashboard')],
['label' => 'Tickets', 'url' => route('complaints.index')],
];
@endphp
@include('layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4 mt-4">
                <div class="card-header bg-gradient-primary text-white rounded-top-4 d-flex align-items-center" style="background: linear-gradient(90deg, #0d6efd 0%, #0a58ca 100%);">
                    <h4 class="mb-0">All Complaints</h4>
                </div>
                <div class="card-body">
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('complaints.index') }}" class="mb-4">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-2">
                                <label class="form-label mb-1">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">All Status</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" {{ collect(request('status'))->contains($status->id) ? 'selected' : '' }}>
                                            {{ $status->display_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label mb-1">Assigned To</label>
                                <select name="by" class="form-select">
                                    <option value="">Assigned To</option>
                                    @foreach($usersList as $user)
                                        <option value="{{ $user->id }}" {{ request('by') == $user->id ? 'selected' : '' }}>
                                            {{ $user->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label mb-1">Vertical</label>
                                <select name="vertical" class="form-select">
                                    <option value="">All Vertical</option>
                                    @foreach($verticals as $vertical)
                                        <option value="{{ $vertical->id }}" {{ request('vertical') == $vertical->id ? 'selected' : '' }}>
                                            {{ $vertical->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label mb-1">Network Type</label>
                                <select name="networktype" class="form-select">
                                    <option value="">All Issue Type</option>
                                    @foreach($networkTypes as $networktype)
                                        <option value="{{ $networktype->id }}" {{ request('networktype') == $networktype->id ? 'selected' : '' }}>
                                            {{ $networktype->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label mb-1">Section</label>
                                <select name="section" class="form-select">
                                    <option value="">All Section</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}" {{ request('section') == $section->id ? 'selected' : '' }}>
                                            {{ $section->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label class="form-label mb-1">From</label>
                                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label mb-1">To</label>
                                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                            </div>
                            <div class="col-md-1 d-grid">
                                <button class="btn btn-secondary mt-2" type="submit">Filter</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Filter Form -->
                    <div class="table-responsive">
                        <table id="complaintsTable" class="table table-hover table-bordered table-striped align-middle w-100">
                            <thead class="table-primary">
                                <tr>
                                    <th>Reference</th>
                                    <th>User</th>
                                    <th>Section</th>
                                    <th>Network</th>
                                    <th>Vertical</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Assigned To</th>
                                    <th>Assigned By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($complaints as $complaint)
                                    <tr>
                                        <td>{{ $complaint->reference_number }}</td>
                                        <td>{{ $complaint->user_name }}</td>
                                        <td>{{ $complaint->section->name }}</td>
                                        <td>{{ $complaint->networkType->name ?? 'N/A' }}</td>
                                        <td>{{ $complaint->vertical->name ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $complaint->status_color }}">
                                                {{ $complaint->status->display_name ?? 'Unknown' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $complaint->priority_color }}">
                                                {{ ucfirst($complaint->priority) }}
                                            </span>
                                        </td>
                                        <td>{{ $complaint->assignedTo?->full_name ?? 'Not Assigned' }}</td>
                                        <td>
                                            @php $assignedBy = $complaint->assigned_by ? \App\Models\User::find($complaint->assigned_by) : null; @endphp
                                            {{ $assignedBy?->full_name ?? 'N/A' }}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('complaints.show', $complaint) }}" class="btn btn-sm btn-info me-1">View</a>
                                                @auth
                                                    @if(auth()->user()->isManager())
                                                        @if($complaint->status->name != 'completed' && $complaint->status->name != 'closed')
                                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#assignModal{{ $complaint->id }}">
                                                                @if($complaint->assigned_to)
                                                                    Reassign
                                                                @else
                                                                    Assign
                                                                @endif
                                                            </button>
                                                        @endif
                                                    @elseif(auth()->user()->isVM())
                                                        @if(($complaint->isUnassigned() || $complaint->assigned_to === auth()->user()->id) && $complaint->status->name != 'completed' && $complaint->status->name != 'closed')
                                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#assignModal{{ $complaint->id }}">
                                                                Assign
                                                            </button>
                                                            @if($complaint->assigned_to === auth()->user()->id && $complaint->status->name != 'completed' && $complaint->status->name != 'closed')
                                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#revertModal{{ $complaint->id }}">
                                                                    Revert
                                                                </button>
                                                            @endif
                                                        @endif
                                                    @elseif(auth()->user()->isNFO())
                                                        @if($complaint->assigned_to === auth()->user()->id && !$complaint->isClosed())
                                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#resolveModal{{ $complaint->id }}">
                                                                Resolve
                                                            </button>
                                                        @endif
                                                        @if($complaint->assigned_to === auth()->user()->id && !$complaint->isCompleted() && !$complaint->isClosed())
                                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#assignModal{{ $complaint->id }}">
                                                                Reassign
                                                            </button>
                                                        @endif
                                                    @endif
                                                @endauth
                                            </div>
                                            <!-- Assign Modal -->
                                            <div class="modal fade" id="assignModal{{ $complaint->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('complaints.assign', $complaint) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Assign Complaint</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="assigned_to" class="form-label">Assign To</label>
                                                                    <select class="form-select" name="assigned_to" required>
                                                                        <option value="">Select User</option>
                                                                        @foreach($complaint->assignableUsers as $user)
                                                                            <option value="{{ $user->id }}">{{ $user->full_name }} ({{ strtoupper($user->role->name) }})</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="description" class="form-label">Remarks</label>
                                                                    <textarea class="form-control" name="description" rows="3" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-primary">Assign</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Resolve Modal -->
                                            <div class="modal fade" id="resolveModal{{ $complaint->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('complaints.resolve', $complaint) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Resolve Ticket</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-check mb-3">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="markClosed{{ $complaint->id }}" name="mark_closed">
                                                                    <label class="form-check-label" for="markClosed{{ $complaint->id }}">
                                                                        Mark as Closed
                                                                    </label>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="status_id" class="form-label">Status *</label>
                                                                    <select class="form-select" id="statusSelect{{ $complaint->id }}" name="status_id" required>
                                                                        @foreach($statuses as $status)
                                                                            <option value="{{ $status->id }}" {{ old('status_id', $complaint->status_id) == $status->id ? 'selected' : '' }}>
                                                                                {{ $status->display_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="description" class="form-label">Remarks / Solution *</label>
                                                                    <textarea class="form-control" name="description" rows="3" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-success">Resolve</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Revert Modal -->
                                            <div class="modal fade" id="revertModal{{ $complaint->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('complaints.revert', $complaint) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Revert to Manager</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="assigned_to" class="form-label">Revert to Manager</label>
                                                                    <select class="form-select" name="assigned_to" required>
                                                                        <option value="">Select Manager</option>
                                                                        @foreach($managers as $manager)
                                                                            <option value="{{ $manager->id }}" @if($manager->id == $complaint->assigned_by) selected @endif>
                                                                                {{ $manager->full_name }}@if($manager->id == $complaint->assigned_by) (Original Assigner)@endif
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="description" class="form-label">Reason for Reverting</label>
                                                                    <textarea class="form-control" name="description" rows="3" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-warning">Revert</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var dt = $('#complaintsTable').DataTable({
        responsive: true,
        order: [[0, 'desc']],
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        language: {
            search: "",
            searchPlaceholder: "Search complaints..."
        },
        dom: '<"datatable-header row mb-3"<"col-md-6"l><"col-md-6 text-end"f>>' +
            '<"datatable-custom-search row mb-2"<"col-12"t>>' +
            '<"datatable-footer row mt-3"<"col-md-6"i><"col-md-6"p>>',
        drawCallback: function() {
            // Re-initialize modals or tooltips if needed
        }
    });
});
</script>
@endpush

@push('style')
<style>
.bg-gradient-primary {
    background: linear-gradient(90deg, #0d6efd 0%, #0a58ca 100%) !important;
    color: #fff !important;
}
.card {
    border-radius: 22px;
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.13);
    border: none;
    margin-bottom: 2rem;
    transition: box-shadow 0.2s;
}
.card-header {
    border-radius: 22px 22px 0 0;
    font-weight: 700;
    font-size: 1.18rem;
    letter-spacing: 0.7px;
    box-shadow: 0 2px 8px rgba(13, 110, 253, 0.07);
}
.table-primary {
    background: linear-gradient(90deg, #0d6efd 0%, #0a58ca 100%) !important;
    color: #fff !important;
    font-size: 1.08rem;
    letter-spacing: 0.5px;
}
.table-bordered {
    border-radius: 14px;
    overflow: hidden;
}
.table-hover tbody tr:hover {
    background: #f0f6ff !important;
    transition: background 0.2s;
}
</style>
@endpush