<?php

namespace App\Http\Livewire\Configure;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Mqtt as ModelsMqtt;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Mqtt extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $listeners = [
        'delete'
    ];
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'host'      => 'required',
        'username'  => 'required',
        'password'  => 'required',
        'port'      => 'required',
    ];

    public $search;
    public $lengthData  = 10;
    public $updateMode  = false;
    public $idRemoved   = NULL;
    public $dataId      = NULL;
    public $idConf, $host, $username, $password, $port;

    public function render()
    {

        $data = ModelsMqtt::get();

        return view('livewire.configure.mqtt', compact('data'))
        ->extends('layouts.apps', ['title' => 'Configure MQTT']);
    }

    public function mount()
    {
        $this->idConf    = ModelsMqtt::min('id');
        $this->changeData($this->idConf);
    }
    
    public function changeData($id)
    {
        $data = ModelsMqtt::where('id', $id)->first();
        $this->host     = $data->host ?? '';
        $this->username = $data->username ?? '';
        $this->password = $data->password ?? '';
        $this->port     = $data->port ?? '';
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
        $this->emit('dataStore');
    }

    public function update()
    {
        $this->validate();

        ModelsMqtt::where('id', 1)->update([
            'host'      => $this->host,
            'username'  => $this->username,
            'password'  => $this->password,
            'port'      => $this->port,
        ]);

        $this->alertShow(
            'success', 
            'Berhasil', 
            'Data berhasil diubah', 
            '', 
            false
        );
    }
}
