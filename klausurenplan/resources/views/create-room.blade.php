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
        // Fetch all rooms and display them
        function fetchRooms() {
            fetch('/api/rooms')
                .then(response => response.json())
                .then(rooms => {
                    const roomList = document.getElementById('room-list');
                    roomList.innerHTML = '';
                    rooms.forEach(room => {
                        const li = document.createElement('li');
                        li.textContent = `${room.name} (Kapazität: ${room.capacity})`;

                        const deleteButton = document.createElement('button');
                        deleteButton.textContent = 'Delete';
                        deleteButton.addEventListener('click', () => {
                            deleteRoom(room.id);
                            fetchRooms();
                        });

                        li.appendChild(deleteButton);
                        roomList.appendChild(li);
                    });
                });
        }

        function deleteRoom(roomId) {
            fetch(`/api/rooms/${roomId}`, {
                method: 'DELETE'
            })
                .then(response => response.json())
                .then(() => {
                    fetchRooms();
                });
        }

        // Create a new room
        document.getElementById('create-room-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch('/api/rooms', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(room => {
                    fetchRooms();
                    this.reset();
                });
        });

        // Fetch rooms on page load
        fetchRooms();
    </script>
</x-app-layout>
