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


