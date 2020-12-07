<?php

namespace App\Http\Livewire\Todo;

use Livewire\WithPagination;
use App\Models\TodoModel;
use App\Models\User;
use Livewire\Component;



class Todo extends Component
{
    use WithPagination;

    public $title;
    public $completed = false;
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;

    
    protected $rules = [
        'title' => 'required|min:3|max:255',
    ];



    public function createTaskModal()
    {
        $this->modalFormVisible = true;
    }
    



    public function createTask()
    {
        $this->validate();
        auth()->user()->todos()->create([
            'title' => $this->title,
            'completed' => false,

        ]);

        $this->title = null;
        $this->modalFormVisible = false;
        
        session()->flash('success', 'Tarefa cadastrada com sucesso!');
        
        //return redirect();
    }



    /*** Delete */
    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function delete()
    {
        TodoModel::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        session()->flash('success', 'Registro removido com sucesso!');
        
    }

    /*** EndDelete */




    public function toggleTodo($id){
        $todo = TodoModel::find($id);
        $todo->completed = !$todo->completed;
        $todo->save();

    }

    public function render()
    {
        //return view('livewire.todo.todo');

        return view('livewire.todo.todo', [
            'todos' => TodoModel::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->where(function($query){
                    if(auth()->check()){
                        $query->where('user_id', auth()->user()->id);
                        }
                })
                ->simplePaginate($this->perPage)
        ]);
    }
}
