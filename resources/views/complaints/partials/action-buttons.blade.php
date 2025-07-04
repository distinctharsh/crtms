@php
    use App\Models\ButtonVisibilityRule;
    $user = auth()->user();
    $roleId = $user->role_id;
    $statusId = $complaint->status_id;
@endphp

{{-- Assign --}}
@if(ButtonVisibilityRule::where('status_id', $statusId)->where('role_id', $roleId)->where('button_type', 'assign')->exists())
    <button type="button" class="btn btn-primary me-2 mb-2" data-bs-toggle="modal" data-bs-target="#assignModal{{ $complaint->id }}">
        <i class="bi bi-person-plus"></i> Assign
    </button>
@endif

{{-- Reassign --}}
@if(ButtonVisibilityRule::where('status_id', $statusId)->where('role_id', $roleId)->where('button_type', 'reassign')->exists())
    <button type="button" class="btn btn-primary me-2 mb-2" data-bs-toggle="modal" data-bs-target="#assignModal{{ $complaint->id }}">
        <i class="bi bi-person-plus"></i> Reassign
    </button>
@endif

{{-- Revert --}}
@if(ButtonVisibilityRule::where('status_id', $statusId)->where('role_id', $roleId)->where('button_type', 'revert')->exists())
    <button type="button" class="btn btn-warning me-2 mb-2" data-bs-toggle="modal" data-bs-target="#revertModal{{ $complaint->id }}">
        <i class="bi bi-arrow-counterclockwise"></i> Revert
    </button>
@endif