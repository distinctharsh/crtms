<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Status;

class RoleStatusSeeder extends Seeder
{
    public function run()
    {
        $manager = Role::where('slug', 'manager')->first();
        $vm = Role::where('slug', 'vm')->first();
        $nfo = Role::where('slug', 'nfo')->first();
        $statuses = Status::all();

        // Manager can use all statuses
        if ($manager) {
            $manager->statuses()->sync($statuses->pluck('id'));
        }

        // VM can use only selected statuses
        if ($vm) {
            $allowedForVM = Status::whereIn('slug', ['pending_with_vendor', 'in_progress', 'completed'])->pluck('id');
            $vm->statuses()->sync($allowedForVM);
        }

        // NFO can use only selected statuses
        if ($nfo) {
            $allowedForNFO = Status::whereIn('slug', ['pending_with_user', 'in_progress', 'completed'])->pluck('id');
            $nfo->statuses()->sync($allowedForNFO);
        }
    }
} 