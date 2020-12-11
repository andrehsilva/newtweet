<div class="max-w-7xl mx-auto py-6 px-4">

    
    <x-slot name="header">
       <b> Usuários </b>
    </x-slot>

    @include('includes.message')

    
    <x-jet-button wire:click="createUserModal" class="flex-shrink-0 bg-green-700 hover:bg-green-900 border-green-700 hover:border-green-900 text-sm border-4 text-white py-3 px-6 rounded" >
        {{ __('Criar Usuário') }}
    </x-jet-button>


<div>
    <div class="w-full flex pt-10 pb-10">
        <div class="w-3/6 mx-1">
            <input wire:model.debounce.300ms="search" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"placeholder="Filtrar usuários...">
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="orderBy" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="id">ID</option>
                <option value="name">Nome</option>
                <option value="email">E-mail</option>
                <option value="created_at">Data de Inscrição</option>
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
    <table class="table-auto w-full mb-6">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">E-mail</th>
                <th class="px-4 py-2">Criado em:</th>
                <th class="px-4 py-2">Ações:</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->id }}</td>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">{{ $user->created_at->diffForHumans() }}</td>
                    <td class="border px-4 py-2">
                    {{-- <a href="{{route('users.edit', $user->id)}}" class="px-2 py-2 bg-teal-700 text-white">Editar</a>
                    <a href="#" wire:click.prevent="remove({{$user->id}})"
                    class="px-2 py-2 bg-red-500 text-white">Remover</a> --}}

                    <x-jet-button wire:click="updateShowModal({{ $user->id }})">
                        {{ __('Editar') }}
                    </x-jet-button>
                    <x-jet-danger-button wire:click="deleteShowModal({{ $user->id }})">
                        {{ __('Excluir') }}
                    </x-jet-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $users->links() !!}
</div>


 {{-- Modal Form --}}
 <x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('Usuários') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <x-jet-label for="name" value="{{ __('Nome do Usuário') }}" />
            <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="name" />
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="email" value="{{ __('E-mail do usuário') }}" />
            <x-jet-input id="email" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="email" />
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>
        @if (!$modelId)
        <div class="flex bg-yellow-100 mb-4 mt-10">
            <div class="w-16 bg-yellow-300">
                <div class="p-4">
                    <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M503.191 381.957c-.055-.096-.111-.19-.168-.286L312.267 63.218l-.059-.098c-9.104-15.01-23.51-25.577-40.561-29.752-17.053-4.178-34.709-1.461-49.72 7.644a66 66 0 0 0-22.108 22.109l-.058.097L9.004 381.669c-.057.096-.113.191-.168.287-8.779 15.203-11.112 32.915-6.569 49.872 4.543 16.958 15.416 31.131 30.62 39.91a65.88 65.88 0 0 0 32.143 8.804l.228.001h381.513l.227.001c36.237-.399 65.395-30.205 64.997-66.444a65.86 65.86 0 0 0-8.804-32.143zm-56.552 57.224H65.389a24.397 24.397 0 0 1-11.82-3.263c-5.635-3.253-9.665-8.507-11.349-14.792a24.196 24.196 0 0 1 2.365-18.364L235.211 84.53a24.453 24.453 0 0 1 8.169-8.154c5.564-3.374 12.11-4.381 18.429-2.833 6.305 1.544 11.633 5.444 15.009 10.986L467.44 402.76a24.402 24.402 0 0 1 3.194 11.793c.149 13.401-10.608 24.428-23.995 24.628z"/><path d="M256.013 168.924c-11.422 0-20.681 9.26-20.681 20.681v90.085c0 11.423 9.26 20.681 20.681 20.681 11.423 0 20.681-9.259 20.681-20.681v-90.085c.001-11.421-9.258-20.681-20.681-20.681zM270.635 355.151c-3.843-3.851-9.173-6.057-14.624-6.057a20.831 20.831 0 0 0-14.624 6.057c-3.842 3.851-6.057 9.182-6.057 14.624 0 5.452 2.215 10.774 6.057 14.624a20.822 20.822 0 0 0 14.624 6.057c5.45 0 10.772-2.206 14.624-6.057a20.806 20.806 0 0 0 6.057-14.624 20.83 20.83 0 0 0-6.057-14.624z"/></svg>
                </div>
            </div>
            <div class="w-auto text-grey-darker items-center p-4">
                <span class="text-lg font-bold pb-4">
                    Atenção:
                </span>
                <p class="leading-tight">
                    A senha será criada automaticamente utilizando o e-mail informado!
                </p>
            </div>
        </div>
        @endif
      
       
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
            {{ __('Cancelar') }}
        </x-jet-secondary-button>

        @if ($modelId)
            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                {{ __('Editar') }}
            </x-jet-danger-button>
        @else
            <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                {{ __('Criar') }}
            </x-jet-danger-button>
        @endif
        
    </x-slot>
</x-jet-dialog-modal>

{{-- The Delete Modal --}}

<x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
    <x-slot name="title">
        {{ __('Deletar Usuário') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Tem certeza que deseja deletar este usuário?') }}
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


