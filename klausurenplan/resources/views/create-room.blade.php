<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Raum erstellen') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <form action="" method="POST" class="space-y-4">
            @csrf

            <div class="flex space-x-4">
                <div class="w-9/12">
                    <label for="email" class="block text-white">Raumbezeichnung:</label>
                    <input type="email" name="email" id="email" class="w-full max-w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="w-3/12">
                    <label for="capacity" class="block text-white">Kapazität:</label>
                    <input type="number" name="capacity" id="capacity" class="w-full max-w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Raum hinzufügen</button>

        </form>
        
    </div>
    
</x-app-layout>
