<?php

namespace App\Http\Livewire\Configure;

use App\Models\Category;
use App\Models\Feature as ModelsFeature;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Feature extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $listeners = [
        'delete'
    ];
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'name_feature'     => 'required',
    ];

    public $search;
    public $lengthData  = 10;
    public $updateMode  = false;
    public $idRemoved   = NULL;
    public $dataId      = NULL;
    public $id_categories, $name_feature;

    public function render()
    {
        $search     = '%'.$this->search.'%';
        $lengthData = $this->lengthData;

        $categories = Category::select('id', 'uuid', 'name_category')->get();

        $data = ModelsFeature::select('feature.*', 'categories.name_category')
                    ->where('name_feature', 'LIKE', $search)
                    ->orWhere('name_category', 'LIKE', $lengthData)
                    ->join('categories', 'categories.uuid', 'feature.id_categories')
                    ->orderBy('feature.id', 'ASC')
                    ->paginate($lengthData);

        return view('livewire.configure.feature', compact('data', 'categories'))
        ->extends('layouts.apps', ['title' => 'Configure Feature']);
    }

    public function mount()
    {
        $id_categories       = Category::min('id');
        $this->name_feature    = '';
        $this->id_categories = Category::select('uuid')->where('id', $id_categories)->first()->uuid;
    }
    
    private function resetInputFields()
    {
        $this->name_feature    = '';
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

        ModelsFeature::create([
            'id_categories'    => $this->id_categories,
            'name_feature'     => $this->name_feature,
        ]);

        $this->alertShow(
            'success', 
            'Berhasil', 
            'Data berhasil ditambahkan', 
            '', 
            false
        );
    }

    public function edit($id)
    {
        $this->updateMode       = true;
        $data = ModelsFeature::where('id', $id)->first();
        $this->dataId           = $id;
        $this->id_categories    = $data->id_categories;
        $this->name_feature     = $data->name_feature;
    }

    public function update()
    {
        $this->validate();

        if( $this->dataId )
        {
            ModelsFeature::findOrFail($this->dataId)->update([
                'id_categories'    => $this->id_categories,
                'name_feature'     => $this->name_feature
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
        ModelsFeature::findOrFail($this->idRemoved)->delete();
        $this->alertShow(
            'success', 
            'Berhasil', 
            'Data berhasil dihapus', 
            '', 
            false
        );
    }
}
