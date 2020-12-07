<?php

namespace App\Http\Livewire\Tweet;

use App\Models\Tweet;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweets extends Component
{
    use WithPagination;

    public $content;
    public $modalFormVisible = false;

    protected $rules = [
        'content' => 'required|min:3|max:255'
    ];

        
    public function createShowModal(){
        $this->modalFormVisible = true;
    }


    public function render()
    {

        $tweets = Tweet::with('user')->latest()->paginate(10);

        return view('livewire.tweet.show-tweets', [
            'tweets' => $tweets
        ]);
    }

    public function create()
    {
        $this->validate();
       
        auth()->user()->tweets()->create([
            'content' => $this->content
        ]);
       

        $this->content ='';
        $this->modalFormVisible = false;
    }


    public function like($idTweet)
    {
        $tweet = Tweet::find($idTweet);

        $tweet->likes()->create([
            'user_id' => auth()->user()->id
        ]);
    }

    public function unlike(Tweet $tweet)
    {
            $tweet->likes()->delete();
    }






   

}
