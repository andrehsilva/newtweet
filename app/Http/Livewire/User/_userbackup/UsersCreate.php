<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersCreate extends Component
{
    public $name;
    public $email;
    public $password;
    


    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6'],
    ];

    public function submit(){
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),

        ]);

        
        session()->flash('success', 'Usuário cadastrado!');
        return redirect()->to('users');
    

    }


    public function render()
    {
        return view('livewire.user.users-create');
    }
}
