<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Role;
use App\Models\StatusTransition;
use Illuminate\Http\Request;

class StatusTransitionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!in_array($user->role_id, [1, 2])) {
            abort(403);
        }
        $roles = Role::all();
        $statuses = Status::active()->ordered()->get();
        $transitions = StatusTransition::all();
        return view('admin.status-transitions', compact('roles', 'statuses', 'transitions'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        if (!in_array($user->role_id, [1, 2])) {
            abort(403);
        }
        $request->validate([
            'from_status_id' => 'required|exists:statuses,id',
            'to_status_ids' => 'array',
            'to_status_ids.*' => 'exists:statuses,id',
            'role_ids' => 'array',
            'role_ids.*' => 'exists:roles,id',
        ]);
        // Remove old transitions for this from_status
        StatusTransition::where('from_status_id', $request->from_status_id)->delete();
        // Add new transitions
        foreach ($request->to_status_ids as $to_status_id) {
            foreach ($request->role_ids as $role_id) {
                StatusTransition::create([
                    'from_status_id' => $request->from_status_id,
                    'to_status_id' => $to_status_id,
                    'role_id' => $role_id,
                ]);
            }
        }
        return redirect()->route('admin.status-transitions.index')->with('success', 'Transitions updated!');
    }
} 