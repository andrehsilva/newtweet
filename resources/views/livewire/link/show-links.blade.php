<div class="max-w-7xl mx-auto py-6 px-4">

    <x-slot name="header">
        <b>Links</b>
        
    </x-slot>

    <x-jet-button wire:click="createLinkModal" class="flex-shrink-0 bg-green-700 hover:bg-green-900 border-green-700 hover:border-green-900 text-sm border-4 text-white py-3 px-6 rounded" >
        {{ __('Criar Link') }}
    </x-jet-button>


    

    @include('includes.message')

    <div class="w-full flex pb-10 mt-10">
        <div class="w-3/6 mx-1">
            <input wire:model.debounce.300ms="search" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"placeholder="Filtrar Links...">
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="orderBy" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="id">ID</option>
                <option value="name">Nome</option>
                <option value="link">Link</option>
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
                <th scope="col" class="px-4 py-2">#</th>
                <th scope="col" class="px-4 py-2">Nome</th>
                <th scope="col" class="px-4 py-2">Link</th>
                <th scope="col" class="px-4 py-2">Ações</th>
            </tr>
        </thead>

        <tbody class=" divide-y divide-gray-200">
            @if ($links->count())
            @foreach($links as $link)
            <tr class="">
                <td class="border px-4 py-2">{{$link->id}}</td>
                <td class="border px-4 py-2">{{$link->name}}</td>
                <td class="border px-4 py-2">{{$link->link}}</td>
                <!--td class="px-6 py-4 whitespace-nowrap">{{$link->created_at->format('d/m/Y H:i:s')}}</td-->
                <td class="border px-4 py-2">
                    {{-- <a href="{{$link->link}}" target="_blank" class="px-2 py-2 bg-blue-700 text-white">Acessar</a>
                   
                    <a href="#"   wire:click.prevent="remove({{$link->id}})"
                    class="button delete-confirm px-2 py-2 bg-red-500 text-white">Remover</a> --}}
                    <a class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 rounded-md border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-3 rounded m-1" href="{{ $link->link }}" target="_blank">
                        {{ __('ABRIR') }}
                    </a>
                    <x-jet-button wire:click="updateShowModal({{ $link->id }})">
                        {{ __('Editar') }}
                    </x-jet-button>
                    <x-jet-danger-button wire:click="deleteShowModal({{ $link->id }})">
                        {{ __('Excluir') }}
                    </x-jet-button>
                </td>
            </tr>
            @endforeach
            @else
                <tr>
                    <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">Sem links cadastrados</td>
                </tr>
            @endif
        </tbody>
    </table>




     {{-- Modal form --}}
     {{-- <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Criar Link') }}
        </x-slot>

        <x-slot name="content">
            <form method="post" wire:submit.prevent="create" >
                <div class="mt-4">
                    <x-jet-label for="name" value="{{ __('Nome do Link') }}" />
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.debounce.800ms="name" require /> 
                    @error('name') <p><span class="text-red-500">{{ $message }}</span></p> @enderror         
                </div>
                <div class="mt-4">
                    <x-jet-label for="link" value="{{ __('Informe o Link') }}" />
                    <x-jet-input id="link" type="text" class="mt-1 block w-full" wire:model.debounce.800ms="link" require /> 
                    @error('link') <p><span class="text-red-500">{{ $message }}</span></p> @enderror         
                </div>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" class="bg-blue-900 text-white p-2 pl-6 pr-6 rounded">Criar Link</button>
        </x-slot>
    </form>
    </x-jet-dialog-modal> --}}
    {{-- Modal form --}}

     






    <div class="w-full mx-auto mt-10">
        @if(count($links))
             {!! $links->links() !!}
        @endif
    </div>





    {{-- Modal Form --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Links') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Nome do Link') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="name" />
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="link" value="{{ __('Endereço do Link') }}" />
                <x-jet-input id="link" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="link" />
                @error('link') <span class="error">{{ $message }}</span> @enderror
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
            {{ __('Deletar Link') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Tem certeza que deseja deletar este link?') }}
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

