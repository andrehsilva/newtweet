<div class="container mx-auto px-4">

    
    <x-slot name="header">
       <b> Tweets </b>
    </x-slot>


    <div class="p-5">

   
    </div>

    <x-jet-button wire:click="createShowModal" class="flex-shrink-0 bg-green-700 hover:bg-green-900 border-green-700 hover:border-green-900 text-sm border-4 text-white py-3 px-6 rounded" >
        {{ __('Criar Tweet') }}
    </x-jet-button>

    

    @foreach ($tweets as $tweet)
        <div class="flex m-8 bg-white shadow-md rounded p-2">   
            <div class="w-1/8 pl-3 text-center">
                @if ($tweet->user->photo)
                    <img src="{{ url("storage/{$tweet->user->photo}") }}" alt="{{ $tweet->user->name }}" class="rounded-lg h-14 w-14">
                @else
                    <img src="{{ url('imgs/no-image.png') }}" alt="{{ $tweet->user->name }}" class="rounded-lg h-14 w-14">
                @endif
                {{-- $tweet->user->name --}}
            </div>
            <div class="w-7/8 pl-3 inline-block align-text-middle">
                {{ $tweet->content }}
                (
                    @if ($tweet->likes->count())
                        <a href="#" wire:click.prevent="unlike({{ $tweet->id }})" class="text-red-500 ">
                            Descurtir</a>
                    @else
                        <a href="#" wire:click.prevent="like({{ $tweet->id }})" class="text-teal-500">
                            Curtir</a>
                    @endif
                )
            </div>
        </div>
    @endforeach

    



    {{-- Modal form --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Criar Tweet') }}
        </x-slot>

        <x-slot name="content">
            <form method="post" wire:submit.prevent="create" >
            
                <textarea name="content" id="content" rows="5" placeholder="O que está pensando?" wire:model="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('content') border-red-500 @enderror"></textarea>
                @error('content') <p><span class="text-red-500">{{ $message }}</span></p> @enderror
                
            
        </x-slot>

        <x-slot name="footer">
           
            <button type="submit" class="bg-blue-900 text-white p-2 pl-6 pr-6 rounded">Criar Tweet</button>
            
        </x-slot>
    </form>
    </x-jet-dialog-modal>




    <div class="py-12">
        {{ $tweets->links() }}
    </div>
</div>