<div class="max-w-7xl mx-auto py-6 px-4">

    <x-slot name="header">
        <b>Minhas tarefas</b>
    </x-slot>

    @include('includes.message')

    <div class=" pb-6">
        <x-jet-button wire:click="createTaskModal" class="flex-shrink-0 bg-green-700 hover:bg-green-900 border-green-700 hover:border-green-900 text-sm border-4 text-white py-3 px-6 rounded" >
            {{ __('Criar Tarefa') }}
        </x-jet-button>
    </div>


<div>
    <div class="w-full flex pb-10">
        <div class="w-3/6 mx-1">
            <input wire:model.debounce.300ms="search" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"placeholder="Filtrar tarefas...">
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="orderBy" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="id">ID</option>
                <option value="title">Nome</option>
               {{--  <option value="completed">Completo</option> --}}
                <option value="created_at">Data da tarefa</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="orderAsc" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="1">Ascendente</option>
                <option value="0">Descendente</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="perPage" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
    </div>
   
    <div class="flex">
       <div class="p-4 w-full">
           <div class="grid grid-cols-12 gap-4">
            @foreach($todos as $todo)
            <div class="col-span-12 sm:col-span-6 md:col-span-3">
            <div class="flex flex-row bg-white shadow-sm rounded p-4">
                <div class="flex flex-col flex-grow ml-4">
                  <div class="font-bold text-lg {{$todo->completed ? 'completed' : ''  }} ">{{ $todo->title }}</div>
                  <div class="text-sm text-gray-500 {{$todo->completed ? 'completed' : ''  }} ">@if ($todo->completed == 1) 
                    Completo
                    @else 
                        Incompleto
                    @endif</div>
                  <div class="mt-10">
                    Finalizado? <input wire:change="toggleTodo({{$todo->id}})" 
                    {{$todo->completed ? 'checked' : ''}}
                    id="active" type="checkbox" class="form-checkbox border appearance-none checked:bg-blue-600 checked:border-transparent px-5 py-3">  |  
                    <a href="#" wire:click="deleteShowModal({{ $todo->id }})" class="flex-shrink-0 text-sm text-red-600"{{-- class="flex-shrink-0 bg-red-500 hover:bg-red-700 text-sm  text-white py-1 px-1 rounded" --}}>Excluir</a>
                  </div>
                </div>
              </div>
            </div>
        @endforeach
            </div>
        </div>
        </div>







            {{-- @foreach($todos as $todo)
                <tr>
                    <td class="border px-4 py-2">{{ $todo->id }}</td>
                    <td class="{{$todo->completed ? 'completed' : ''  }} border px-4 py-2">{{ $todo->title }}</td>
                    <td class="{{$todo->completed ? 'completed' : ''  }} border px-4 py-2">@if ($todo->completed == 1) 
                                                        Completo
                                                        @else 
                                                            Incompleto
                                                        @endif
                    </td>
                    <td class="{{$todo->completed ? 'completed' : ''  }} border px-4 py-2">{{ $todo->created_at->diffForHumans() }}</td>
                    <td class="border px-4 py-2">
                        <input wire:change="toggleTodo({{$todo->id}})" 
                    {{$todo->completed ? 'checked' : ''}}
                    id="active" type="checkbox" class="form-checkbox border appearance-none checked:bg-blue-600 checked:border-transparent px-4 py-2">

                        <x-jet-danger-button wire:click="deleteShowModal({{ $todo->id }})">
                            {{ __('Excluir') }}
                        </x-jet-button>


                    </td>
                </tr>
            @endforeach --}}
        
    {!! $todos->links() !!}
</div>


{{-- Modal form --}}
<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('Criar Tarefa') }}
    </x-slot>

    <x-slot name="content">
        <form method="post" wire:submit.prevent="createTask" >
            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Qual a tarefa agora?') }}" />
                <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.debounce.800ms="title" require /> 
                @error('title') <p><span class="text-red-500">{{ $message }}</span></p> @enderror         
            </div>
            
    </x-slot>
    <x-slot name="footer">
        <button type="submit" wire:keydown.enter="createTask" class="bg-blue-900 text-white p-2 pl-6 pr-6 rounded">Criar Tarefa</button>
    </x-slot>
</form>
</x-jet-dialog-modal>
{{-- Modal form --}}



    {{-- The Delete Modal --}}

    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Deletar Tarefa') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Tem certeza que deseja deletar esta Tarefa?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Deletar!') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>




</div>