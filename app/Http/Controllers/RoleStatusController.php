<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Status;
use Illuminate\Http\Request;

class RoleStatusController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id;
        if (!in_array($user->role_id, [1, 2])) {
            abort(403);
        }
        $roles = Role::all();
        $allStatuses = Status::active()->ordered()->get();
        return view('admin.role-status', compact('roles', 'allStatuses'));
    }

    public function update(Request $request, Role $role)
    {
        $user = auth()->user()->id;
        if (!in_array($user->role_id, [1, 2])) {
            abort(403);
        }
        $request->validate([
            'status_ids' => 'array',
            'status_ids.*' => 'exists:statuses,id',
        ]);
        $role->statuses()->sync($request->status_ids ?? []);
        return redirect()->route('admin.role-status.index')->with('success', 'Statuses updated for role: ' . $role->name);
    }
} 