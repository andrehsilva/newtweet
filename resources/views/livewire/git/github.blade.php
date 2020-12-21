<div class="max-w-7xl mx-auto py-6 px-4">

    <x-slot name="header">
        <b>Pesquisar no Git</b>
    </x-slot>

    @include('includes.message')

    


<div>
    <div class="flex justify-items-auto mb-20">
        
            <form method="post" wire:submit.prevent="getDataGithub()" >
               
                    <x-jet-input id="username" type="text" class="w-3/5" wire:model.debounce.800ms="username" require placeholder="Pesquise um usuário..."/>
                     @error('username') <p><span class="text-red-500">{{ $message }}</span></p> @enderror 
                    <button type="submit"  class="bg-blue-600 text-white p-2 pl-6 pr-6 rounded">Pesquisar</button>
                
            </form>
                

            
       
        
    </div>

</div>

@if($profile)

<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
    <div class="md:flex">
      <div class="md:flex-shrink-0">
        <img class="h-48 w-full object-cover md:w-48" src="{{$profile['avatar_url']}}}" alt="Man looking at item at a store">
      </div>
      <div class="p-8">
        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold my-5">{{$profile['name']}}</div>
        <a href="{{$profile['html_url']}}" target="_blank" class="bg-blue-500 text-white p-2 pl-6 pr-6 rounded">Acessar Github</a></div>
    </div>
  </div>




                 
                
            @endif

            










</div>

