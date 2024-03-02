<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Aufsichtsperson hinzufügen') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <form action="" method="POST" class="space-y-4">
            @csrf

            <div class="form-group flex">
                <div class="w-1/2 mr-2">
                    <label for="name" class="block text-white">Vorname:</label>
                    <input type="text" name="name" id="name" class="w-full max-w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="w-1/2">
                    <label for="lastname" class="block text-white">Nachname:</label>
                    <input type="text" name="lastname" id="lastname" class="w-full max-w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

            <div class="form-group">
                <label for="fachbereich" class="block text-white">Fachbereich:</label>
                <select name="fachbereich" id="fachbereich" class="w-full max-w-full border-gray-300 rounded-md shadow-sm">
                    <option value="fachbereich1">Fachbereich 1</option>
                    <option value="fachbereich2">Fachbereich 2</option>
                    <option value="fachbereich3">Fachbereich 3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email" class="block text-white">Email:</label>
                <input type="email" name="email" id="email" class="w-full max-w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Aufsichtsperson erstellen</button>
        </form>
        
    </div>
    
</x-app-layout>
