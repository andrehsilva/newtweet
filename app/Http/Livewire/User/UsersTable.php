<?php



namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class UsersTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    public $name;
    public $email;
    public $password;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;



    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        /* 'password' => ['required', 'string', 'min:6'], */
    ];


 

/*** Create */
    public function createUserModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    public function create()
    {
       /*  $this->validate();
        auth()->user()->links()->create([
            'name' => $this->name,
            'link' => $this->link,]);
        $this->modalFormVisible = false;
        $this->reset();
        session()->flash('success', 'Link cadastrado com sucesso!'); */
        

        $this->validate();
        $this->password = $this->email;
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)

        ]);

        
        session()->flash('success', 'Usuário cadastrado!');
        return redirect()->to('users');
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
        User::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        session()->flash('message', 'Usuário atualizado com sucesso!'); 
    }


    public function loadModel()
    {
        $users = User::find($this->modelId);
        $this->name = $users->name;
        $this->email = $users->email;
        $this->password = $users->password;
    }

    public function modelData()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
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
        User::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        session()->flash('success', 'Usuário removido com sucesso!');
        
    }

    /*** EndDelete */




    
    public function render()
    {
        return view('livewire.user.users-table', [
            'users' => User::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }

  




}