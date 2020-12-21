<?php

namespace App\Http\Livewire\Category;

use App\Models\Category as ModelsCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use App\Models\User;


class Category extends Component
{

    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    public $name;
    public $is_published;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;



    protected $rules = [
        'name' => 'required|min:3|max:255',
    ]; 


    public function createCatModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    public function create()
    {
        $this->validate();
        $slug = Str::slug($this->name, '-');

        auth()->user()->categories()->create([
            'name' => $this->name,
            'slug' => $slug,
            'is_published' => 1
        ]);
        $this->modalFormVisible = false;
        $this->reset();
        session()->flash('success', 'Categoria cadastrada com sucesso!');
        
    }


    public function updateShowModal($id)
    {
        
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }


    public function update()
    {
        $this->validate();
        ModelsCategory::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        session()->flash('message', 'Categoria atualizada com sucesso!');
    }


    public function loadModel()
    {
        $category = ModelsCategory::find($this->modelId);
        $this->name = $category->name;
    }

    public function modelData()
    {
        return [
            'name' => $this->name,
        ];
    }



    /*** Delete */
public function deleteShowModal($id)
{
    $this->modelId = $id;
    $this->modalConfirmDeleteVisible = true;
}

public function delete()
{
    ModelsCategory::destroy($this->modelId);
    $this->modalConfirmDeleteVisible = false;
    session()->flash('success', 'Categoria removida com sucesso!');
    
}





    public function render()
    {
        return view('livewire.category.category', [
            'categories' => ModelsCategory::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
                ->simplePaginate($this->perPage),
        ]);
    }
}
