<?php

namespace App\Http\Controllers;

use App\Models\ButtonVisibilityRule;
use App\Models\Status;
use App\Models\Role;
use Illuminate\Http\Request;

class ButtonVisibilityController extends Controller
{
    public function index()
    {
        $statuses = Status::ordered()->get();
        $roles = Role::whereIn('slug', ['manager', 'vm', 'nfo'])->get();
        $rules = ButtonVisibilityRule::all();
        $buttonTypes = ['assign', 'reassign', 'revert'];
        return view('admin.button-visibility', compact('statuses', 'roles', 'rules', 'buttonTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id',
            'role_id' => 'required|exists:roles,id',
            'button_type' => 'required|in:assign,reassign,revert',
        ]);
        ButtonVisibilityRule::firstOrCreate($request->only('status_id', 'role_id', 'button_type'));
        return back()->with('success', 'Button visibility rule added!');
    }

    public function destroy(ButtonVisibilityRule $rule)
    {
        $rule->delete();
        return back()->with('success', 'Button visibility rule removed!');
    }
} 