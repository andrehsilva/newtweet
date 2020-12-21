<?php

namespace App\Http\Livewire\Git;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Github extends Component
{


    public $username;
    public $profile;

    public function getDataGithub(){
        

        $response = Http::get('https://api.github.com/users/' . $this->username);
        //dd($response->json());
        $this->profile = $response->json();

    }


    public function render()
    {
        return view('livewire.git.github');
    }
}
