<?php

namespace App\Http\Livewire\Device;

use App\Models\Room;
use App\Models\Device;
use App\Models\Feature;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Monitoring extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $listeners = [
        'delete'
    ];
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'id_room'       => 'required',
        'id_feature'    => 'required',
        'name_device'   => 'required|unique:device,name_device',
        'topic'         => 'required|unique:device,topic',
        'retain'        => 'required',
    ];

    public $search;
    public $lengthData  = 10;
    public $updateMode  = false;
    public $idRemoved   = NULL;
    public $dataId      = NULL;
    public $id_room, $id_feature, $name_device, $topic, $retain, $active, $inactive;

    public function render()
    {
        $search     = '%' . $this->search . '%';
        $lengthData = $this->lengthData;

        $rooms = Room::select('uuid', 'name_room')->get();

        $features = Feature::select('feature.uuid', 'feature.name_feature')
            ->join('categories', 'categories.uuid', 'feature.id_categories')
            ->where('categories.name_category', 'KWH MONITORING')
            ->get();

        $data = Device::select('device.*', 'room.name_room', 'feature.name_feature')
            ->join('room', 'room.uuid', 'device.id_room')
            ->join('feature', 'feature.uuid', 'device.id_feature')
            ->join('categories', 'categories.uuid', 'feature.id_categories')
            ->where(function ($query) use ($search) {
                $query->where('name_device', 'LIKE', $search);
                $query->orWhere('topic', 'LIKE', $search);
                $query->orWhere('retain', 'LIKE', $search);
            })
            ->where('categories.name_category', 'KWH MONITORING')
            ->orderBy('id', 'ASC')
            ->paginate($lengthData);

        return view('livewire.device.monitoring', compact('data', 'rooms', 'features'))
            ->extends('layouts.apps', ['title' => 'Configure Device - KWH MONITORING']);
    }

    public function mount()
    {
        $id_room             = Room::min('id');
        $id_feature          = Feature::join('categories', 'categories.uuid', 'feature.id_categories')
            ->where('categories.name_category', 'KWH MONITORING')
            ->min('feature.id');
        $this->id_room       = Room::select('uuid')->where('id', $id_room)->first()->uuid ?? "";
        $this->id_feature    = Feature::select('uuid')->where('id', $id_feature)->first()->uuid ?? "";
        $this->name_device   = 'KWH MONITORING';
        $this->topic         = '';
        $this->retain        = 'true';
        $this->active        = '';
        $this->inactive      = '';
    }

    private function resetInputFields()
    {
        $this->name_device   = 'KWH MONITORING';
    }

    public function cancel()
    {
        $this->updateMode       = false;
        $this->resetInputFields();
    }

    private function alertShow($type, $title, $text, $onConfirmed, $showCancelButton)
    {
        $this->alert($type, $title, [
            'position'          => 'center',
            'timer'             => '3000',
            'toast'             => false,
            'text'              => $text,
            'showConfirmButton' => true,
            'onConfirmed'       => $onConfirmed,
            'showCancelButton'  => $showCancelButton,
            'onDismissed'       => '',
        ]);
        $this->resetInputFields();
        $this->emit('dataStore');
    }

    public function store()
    {
        $this->validate();

        Device::create([
            'id_room'       => $this->id_room,
            'id_feature'    => $this->id_feature,
            'name_device'   => $this->name_device,
            'topic'         => $this->topic,
            'retain'        => $this->retain,
            'active'        => $this->active,
            'inactive'      => $this->inactive,
        ]);

        $this->alertShow(
            'success',
            'Berhasil',
            'Device berhasil ditambahkan',
            '',
            false
        );
    }

    public function edit($id)
    {
        $this->updateMode   = true;
        $data = Device::where('id', $id)->first();
        $this->dataId       = $id;
        $this->id_room      = $data->id_room;
        $this->id_feature   = $data->id_feature;
        $this->name_device  = $data->name_device;
        $this->topic        = $data->topic;
        $this->retain       = $data->retain;
        $this->active       = $data->active;
        $this->inactive     = $data->inactive;
    }

    public function update()
    {
        $this->validate();

        if ($this->dataId) {
            Device::findOrFail($this->dataId)->update([
                'id_room'       => $this->id_room,
                'id_feature'    => $this->id_feature,
                'name_device'   => $this->name_device,
                'topic'         => $this->topic,
                'retain'        => $this->retain,
                'active'        => $this->active,
                'inactive'      => $this->inactive,
            ]);
            $this->alertShow(
                'success',
                'Berhasil',
                'Device berhasil diubah',
                '',
                false
            );
        }
    }

    public function deleteConfirm($id)
    {
        $this->idRemoved = $id;
        $this->alertShow(
            'warning',
            'Apa anda yakin?',
            'Jika anda menghapus data tersebut, data tidak bisa dikembalikan!',
            'delete',
            true
        );
        // dd($this->idRemoved);
    }

    public function delete()
    {
        Device::findOrFail($this->idRemoved)->delete();
        $this->alertShow(
            'success',
            'Berhasil',
            'Data berhasil dihapus',
            '',
            false
        );
    }
}
