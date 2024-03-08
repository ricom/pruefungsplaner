<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Aufsichtsperson hinzufügen') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form id="supervisor-form" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="form-group flex">
                <div class="w-1/2 mr-2">
                    <label for="name" class="block text-sm font-medium text-gray-300">Vorname:</label>
                    <input type="text" name="name" id="name" class="w-full max-w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="w-1/2">
                    <label for="lastname" class="block text-sm font-medium text-gray-300">Nachname:</label>
                    <input type="text" name="lastname" id="lastname" class="w-full max-w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-gray-300">Email:</label>
                <input type="email" name="email" id="email" class="w-full max-w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <button id="submit-button" type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Aufsichtsperson erstellen</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('supervisor-form');

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const formData = new FormData(form);

                fetch('/api/supervisors', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    alert('Aufsichtsperson wurde erfolgreich erstellt.');
                    form.reset();
                })
                .catch(error => {
                    alert('Fehler beim Erstellen der Aufsichtsperson.');
                });
            });
        }); 
    </script>
</x-app-layout>
