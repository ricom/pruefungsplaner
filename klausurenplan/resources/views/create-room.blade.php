<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Raum erstellen') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Form for creating a new room -->
        <form id="create-room-form" class="space-y-4">
            @csrf
            <div class="flex space-x-4">
                <div class="w-6/12">
                    <label for="name" class="block text-sm font-medium text-gray-300">Raumbezeichnung:</label>
                    <input type="text" name="name" id="name" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="w-6/12">
                    <label for="capacity" class="block text-sm font-medium text-gray-300">Kapazität:</label>
                    <input type="number" name="capacity" id="capacity" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Raum hinzufügen</button>
        </form>

        <!-- Container for listing rooms -->
        <div id="rooms-list" class="mt-8">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Verfügbare Räume</h3>
            <ul class="mt-3 max-w-2xl text-sm text-gray-500" id="room-list"></ul>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetchRooms();

            document.getElementById('create-room-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = {
                    name: document.getElementById('name').value,
                    capacity: document.getElementById('capacity').value,
                };
                createRoom(formData);
            });
        });

        function fetchRooms() {
            fetch('/api/rooms') // Adjust the URL to match your API endpoint
            .then(response => response.json())
            .then(data => {
                const list = document.getElementById('room-list');
                list.innerHTML = ''; // Clear existing rooms
                data.forEach(room => {
                    const item = document.createElement('li');
                    item.classList.add('py-4', 'flex', 'justify-between');
                    item.innerHTML = `
                        <span>Raumbezeichnung: ${room.name}, Kapazität: ${room.capacity}</span>
                        <div>
                            <button onclick="editRoom(${room.id})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            <button onclick="deleteRoom(${room.id})" class="text-red-600 hover:text-red-900">Delete</button>
                        </div>
                    `;
                    list.appendChild(item);
                });
            })
            .catch(error => {
                console.error('Error fetching rooms:', error);
            });
        }

        function createRoom(formData) {
            // Implement AJAX call to POST /api/rooms with formData
        }

        function editRoom(roomId) {
            // Implement functionality to edit a room, possibly by populating the form with existing values and adjusting the form action
        }

        function deleteRoom(roomId) {
            // Implement AJAX call to DELETE /api/rooms/{roomId}
        }
    </script>
</x-app-layout>
