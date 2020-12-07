<?php

namespace App\Http\Livewire\Link;

use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\Link;
use App\Models\User;
use Livewire\WithPagination;


class ShowLinks extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    public $name;
    public $link;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;
    public $success;


    protected $rules = [
        'name' => 'required|min:3|max:255',
        'link' => 'required|min:3|max:255',
    ]; 

 

/*** Create */
    public function createLinkModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    public function create()
    {
        $this->validate();
        auth()->user()->links()->create([
            'name' => $this->name,
            'link' => $this->link,]);
        $this->modalFormVisible = false;
        $this->reset();
        session()->flash('success', 'Link cadastrado com sucesso!');
        
    }

    /*** EndCreate */


    public function updateShowModal($id)
    {
        
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }


    public function update()
    {
        $this->validate();
        Link::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        session()->flash('message', 'Link atualizado com sucesso!');
    }


    public function loadModel()
    {
        $links = Link::find($this->modelId);
        $this->name = $links->name;
        $this->link = $links->link;
    }

    public function modelData()
    {
        return [
            'name' => $this->name,
            'link' => $this->link,
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
    Link::destroy($this->modelId);
    $this->modalConfirmDeleteVisible = false;
    session()->flash('success', 'Link removido com sucesso!');
    
}



    public function render()
    {
        //$links = Link::with('user')->latest()->paginate(10);
        // return view('livewire.link.show-links', compact('links'));

        return view('livewire.link.show-links', [
            'links' => Link::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
                ->simplePaginate($this->perPage),
        ]);
    }
















      /* public function remove($links)
    {
        $links = auth()->user()->links()->find($links);
        $links->delete();

        session()->flash('message', 'Registro removido com sucesso!');
    } */

}
