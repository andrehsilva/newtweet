<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersEdit extends Component
{


    public $name;
    public $email;
    

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
       
    ];

    public function mount($id)
        {
           $usernew = User::find($id);

           $this->name = $usernew->name;
           $this->email = $usernew->email;
           
        }


        public function update()
        {
            $this->validate();

            

           

        
            session()->flash('success', 'Usuário atualizado com sucesso!');
            return redirect()->to('users');
        
            
           // $this->amount = $this->description = $this->type = null;
        
        }



    public function render()
    {
        return view('livewire.user.users-edit');
    }
}
