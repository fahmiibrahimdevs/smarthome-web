<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Room;
use App\Models\Device;
use Livewire\Component;

class DashboardDevice extends Component
{
    public $uuid;

    public function render()
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

        $data = Device::select('device.id', 'device.uuid', 'device.name_device', 'device.topic', 'device.retain', 'room.name_room', 'feature.name_feature', 'device.active', 'device.inactive')
                    ->join('room', 'room.uuid', 'device.id_room')
                    ->join('feature', 'feature.uuid', 'device.id_feature')
                    ->whereIn('feature.name_feature', ['LAMP', 'AC'])
                    ->where('device.id_room', $this->uuid)
                    ->orderBy('device.id', 'ASC')
                    ->get();

        return view('livewire.dashboard.dashboard-device', compact('rooms', 'data'))
        ->extends('layouts.apps', ['title' => 'Dashboard Device']);
    }

    public function mount($uuidRoom)
    {
        $this->uuid = $uuidRoom;
    }
}
