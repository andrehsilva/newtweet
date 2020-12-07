<div class="container mx-auto px-4">

    
    <x-slot name="header">
       <b> Avatar </b>
    </x-slot>


<div class="container mx-auto px-4">
    <h1 class="text-2xl py-6 font-bold">Atualizar Foto do Perfil</h1>
    <form wire:submit.prevent="storagePhoto" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8 m-8">
        @if ($photo)
            <div class="mb-4">
                <img src="{{ $photo->temporaryUrl() }}" style="max-width: 200px;">
            </div>
        @endif
        <div class="mb-4">
            <input type="file" wire:model="photo">
        </div>

        @error('photo') <p><span class="text-red-500">{{ $message }}</span></p> @enderror

        <button type="submit" class="bg-blue-900 text-white p-2 pl-6 pr-6 rounded">Upload Foto</button>
    </form>
</div>


</div>