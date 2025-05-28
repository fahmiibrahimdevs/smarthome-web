<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use LivewireAlert;
    use WithPagination;

    public function render()
    {
        if( Auth::user()->hasRole('admin') )
        {
            $rooms = Room::select('room.uuid', 'name_room')
                    ->selectRaw('COUNT(DISTINCT device.topic) as available_devices')
                    ->leftJoin('device', function ($join) {
                        $join->on('device.id_room', '=', 'room.uuid')
                            ->whereIn('device.id_feature', ['49378b8e-0936-481e-b96d-c4a21d6050b5', '0b3c3c8f-b971-44e3-bf29-f3e1b4d329fc']);
                    })
                    ->groupBy('room.uuid', 'name_room')
                    ->orderBy('room.id', 'asc')
                    ->get();

            return view('livewire.dashboard.dashboard-admin', compact('rooms'))
            ->extends('layouts.apps', ['title' => 'Dashboard']);
        } else if ( Auth::user()->hasRole('user') )
        {
            return view('livewire.dashboard.dashboard-user')
            ->extends('layouts.apps', ['title' => 'Dashboard']);
        } else if ( Auth::user()->hasRole('developer') )
        {
            return view('livewire.dashboard.dashboard-developer')
            ->extends('layouts.apps', ['title' => 'Dashboard']);
        }

    }
}
