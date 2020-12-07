<div class="max-w-7xl mx-auto py-6 px-4">

    <x-slot name="header">
        <b>Criar usuário</b>
    </x-slot>

    @include('includes.message')
    
    <form action="" wire:submit.prevent="submit" class="w-full max-w-7xl mx-auto">
        <div class="flex flex-wrap -mx-3 mb-6">

            <p class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nome</label>
                <input type="text" name="name" wire:model="name"
                class="block appearance-none w-full bg-gray-200 border @error('name') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            @error('name')
            <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror
            </p>


            <p class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">E-mail</label>
                <input type="text" name="email" wire:model="email"
                class="block appearance-none w-full bg-gray-200 border @error('email') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            @error('email')
            <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror

            </p>

            <p class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Senha</label>
                <input type="password" name="password" wire:model="password"
                class="block appearance-none w-full bg-gray-200 border @error('password') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            @error('password')
            <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror

            </p>



            

        </div>
        <div class="w-full py-4  mb-6 md:mb-0">

            <button type="submit"
                    class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">Criar Usuário</button>
        </div>

    </form>















</div>
