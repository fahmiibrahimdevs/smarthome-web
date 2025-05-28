<?php

namespace App\Http\Livewire\Configure;

use App\Models\Location;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Room as ModelsRoom;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Room extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $listeners = [
        'delete'
    ];
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'name_room'     => 'required',
    ];

    public $search;
    public $lengthData  = 10;
    public $updateMode  = false;
    public $idRemoved   = NULL;
    public $dataId      = NULL;
    public $name_room, $id_location;

    public function render()
    {
        $search     = '%' . $this->search . '%';
        $lengthData = $this->lengthData;

        $locations = Location::select('id', 'uuid', 'name_location')->get();

        $data = ModelsRoom::select('room.*', 'location.name_location')
            ->where('name_room', 'LIKE', $search)
            ->orWhere('name_location')
            ->join('location', 'location.uuid', 'room.id_location')
            ->orderBy('room.id', 'ASC')
            ->paginate($lengthData);
        // dd($data);

        return view('livewire.configure.room', compact('data', 'locations'))
            ->extends('layouts.apps', ['title' => 'Configure Room']);
    }

    public function mount()
    {
        $id_location = Location::min('id');
        $this->id_location = Location::select('uuid')->where('id', $id_location)->first()->uuid ?? "";
        $this->name_room    = '';
    }

    private function resetInputFields()
    {
        $this->name_room    = '';
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

        ModelsRoom::create([
            'id_location'   => $this->id_location,
            'name_room'     => $this->name_room,
        ]);

        $this->alertShow(
            'success',
            'Success',
            'Data inserted successfully',
            '',
            false
        );
    }

    public function edit($id)
    {
        $this->updateMode       = true;
        $data = ModelsRoom::where('id', $id)->first();
        $this->dataId           = $id;
        $this->name_room    = $data->name_room;
    }

    public function update()
    {
        $this->validate();

        if ($this->dataId) {
            ModelsRoom::findOrFail($this->dataId)->update([
                'id_location'   => $this->id_location,
                'name_room'     => $this->name_room
            ]);
            $this->alertShow(
                'success',
                'Success',
                'Data updated successfully',
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
            'Are you sure?',
            'If you delete the data, the data can not be restored!',
            'delete',
            true
        );
        // dd($this->idRemoved);
    }

    public function delete()
    {
        ModelsRoom::findOrFail($this->idRemoved)->delete();
        $this->alertShow(
            'success',
            'Success',
            'Data deleted successfully',
            '',
            false
        );
    }
}
