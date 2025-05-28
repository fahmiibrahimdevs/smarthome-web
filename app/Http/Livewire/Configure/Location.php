<?php

namespace App\Http\Livewire\Configure;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Location as ModelsLocation;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Location extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $listeners = [
        'delete'
    ];
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'name_location'     => 'required',
    ];

    public $search;
    public $lengthData  = 10;
    public $updateMode  = false;
    public $idRemoved   = NULL;
    public $dataId      = NULL;
    public $name_location;

    public function render()
    {
        $search     = '%'.$this->search.'%';
        $lengthData = $this->lengthData;

        $data = ModelsLocation::where('name_location', 'LIKE', $search)
                    ->orderBy('id', 'ASC')
                    ->paginate($lengthData);
                    // dd($data);

        return view('livewire.configure.location', compact('data'))
        ->extends('layouts.apps', ['title' => 'Configure Location']);
    }

    public function mount()
    {
        $this->name_location    = '';
    }
    
    private function resetInputFields()
    {
        $this->name_location    = '';
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

        ModelsLocation::create([
            'name_location'     => $this->name_location,
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
        $data = ModelsLocation::where('id', $id)->first();
        $this->dataId           = $id;
        $this->name_location    = $data->name_location;
    }

    public function update()
    {
        $this->validate();

        if( $this->dataId )
        {
            ModelsLocation::findOrFail($this->dataId)->update([
                'name_location'     => $this->name_location
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
        ModelsLocation::findOrFail($this->idRemoved)->delete();
        $this->alertShow(
            'success', 
            'Success', 
            'Data deleted successfully', 
            '', 
            false
        );
    }
}