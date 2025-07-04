@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Status Workflow Management</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.status-transitions.update') }}" id="transitionForm">
                @csrf
                <input type="hidden" name="transition_id" id="transition_id">
                <div class="mb-3">
                    <label for="from_status_id" class="form-label fw-bold">From Status</label>
                    <select name="from_status_id" id="from_status_id" class="form-select form-select-lg mb-2" required>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->display_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Allowed Next Statuses</label>
                    <div class="row g-2">
                        @foreach($statuses as $status)
                            <div class="col-6 col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="to_status_ids[]" value="{{ $status->id }}" id="to_status_{{ $status->id }}">
                                    <label class="form-check-label" for="to_status_{{ $status->id }}">
                                        <span class="badge bg-light text-dark border">{{ $status->display_name }}</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Allowed Roles for this Transition</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($roles->whereIn('slug', ['manager', 'vm', 'nfo']) as $role)
                            @php
                                $roleColors = [
                                    'manager' => 'primary',
                                    'vm' => 'success',
                                    'nfo' => 'info',
                                ];
                                $color = $roleColors[strtolower($role->slug)] ?? 'secondary';
                            @endphp
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role_ids[]" value="{{ $role->id }}" id="role_{{ $role->id }}">
                                <label class="form-check-label" for="role_{{ $role->id }}">
                                    <span class="badge bg-{{ $color }} px-3 py-2"><i class="bi bi-person-badge"></i> {{ ucfirst($role->name) }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-primary w-100 mt-3 shadow"><i class="bi bi-save me-2"></i>Save Transitions</button>
            </form>
        </div>
    </div>
    <hr>
    <h4>Existing Transitions</h4>
    @php
        // Get all unique from-to status pairs
        $statusPairs = collect($transitions)
            ->map(fn($t) => [$t->from_status_id, $t->to_status_id])
            ->unique()
            ->values();
        // Only show these roles
        $allowedRoleSlugs = ['manager', 'vm', 'nfo'];
        $roleSlugs = $allowedRoleSlugs;
        $roleLabels = ['manager' => 'Manager', 'vm' => 'VM', 'nfo' => 'NFO'];
        $badgeClasses = ['manager' => 'primary', 'vm' => 'success', 'nfo' => 'info'];
    @endphp
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center bg-white shadow-sm">
            <thead class="table-light">
                <tr>
                    <th style="width:30%">From → To</th>
                    @foreach($roleSlugs as $slug)
                        <th style="width:23%">{{ $roleLabels[$slug] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($statusPairs as $pair)
                    @php
                        $fromStatus = $statuses->firstWhere('id', $pair[0]);
                        $toStatus = $statuses->firstWhere('id', $pair[1]);
                    @endphp
                    <tr>
                        <td class="text-start">
                            <span class="badge bg-secondary">{{ $fromStatus->display_name ?? '?' }}</span>
                            <i class="bi bi-arrow-right mx-1"></i>
                            <span class="badge bg-light text-dark">{{ $toStatus->display_name ?? '?' }}</span>
                        </td>
                        @foreach($roleSlugs as $slug)
                            <td>
                                @php
                                    $transition = $transitions->first(fn($t) => $t->from_status_id == $pair[0] && $t->to_status_id == $pair[1] && strtolower($t->role->slug) == $slug);
                                @endphp
                                @if($transition)
                                    <span class="badge bg-{{ $badgeClasses[$slug] }}">Allowed</span>
                                    <form method="POST" action="{{ route('admin.status-transitions.destroy', $transition->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger ms-1" title="Delete" onclick="return confirm('Are you sure you want to delete this transition?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                    <button type="button" class="btn btn-sm btn-primary edit-btn ms-1" title="Edit"
                                        data-id="{{ $transition->id }}"
                                        data-from="{{ $transition->from_status_id }}"
                                        data-to="{{ $transition->to_status_id }}"
                                        data-role="{{ $transition->role_id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.edit-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.getElementById('transition_id').value = btn.dataset.id;
            document.getElementById('from_status_id').value = btn.dataset.from;
            // Uncheck all to_status checkboxes
            document.querySelectorAll('input[name="to_status_ids[]"]').forEach(function(cb) {
                cb.checked = false;
            });
            // Check the correct to_status
            var toStatus = btn.dataset.to;
            var toCb = document.getElementById('to_status_' + toStatus);
            if (toCb) toCb.checked = true;
            // Uncheck all role checkboxes
            document.querySelectorAll('input[name="role_ids[]"]').forEach(function(cb) {
                cb.checked = false;
            });
            // Check the correct role
            var roleCb = document.getElementById('role_' + btn.dataset.role);
            if (roleCb) roleCb.checked = true;
        });
    });
});
</script>
@endsection 