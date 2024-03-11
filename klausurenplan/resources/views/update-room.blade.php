<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Räume bearbeiten') }}
        </h2>
    </x-slot>

    <div class="room-list">
        <div class="bg-gray-100 p-4 m-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold leading-tight">H101</h1>
            <h1 class="text-2xl font-bold leading-tight">34</h1>
            <div class="">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Ändern</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Löschen</button>
            </div>
        </div>
        
        <div class="bg-gray-100 p-4 m-4 flex items-center justify-between">
            <input type="text" class="text-2xl font-bold leading-tight" value="H101">
            <input type="number" class="text-2xl font-bold leading-tight" value="34">
            <div class="">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Speichern</button>
            </div>
        </div>
    </div> 

    <div id="room-list"></div> 

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Fetch all rooms and display them
            function fetchRooms() {
                fetch('/api/rooms')
                    .then(response => response.json())
                    .then(rooms => {
                        const roomList = document.getElementById('room-list');
                        roomList.innerHTML = '';
                        rooms.forEach(room => {
                            const div = document.createElement('div');
                            div.classList.add('room-item ');

                            const roomName = document.createElement('div');
                            roomName.textContent = room.name;
                            div.appendChild(roomName);

                            const roomCapacity = document.createElement('div');
                            roomCapacity.textContent = `Kapazität: ${room.capacity}`;
                            div.appendChild(roomCapacity);

                            const deleteButton = document.createElement('button');
                            deleteButton.textContent = 'Löschen';
                            deleteButton.classList.add('delete-button');
                            deleteButton.addEventListener('click', () => {
                                deleteRoom(room.id);
                                fetchRooms();
                            });
                            div.appendChild(deleteButton);

                            const updateButton = document.createElement('button');
                            updateButton.textContent = 'Bearbeiten';
                            updateButton.classList.add('update-button');
                            updateButton.addEventListener('click', () => {
                                const newName = prompt('Neuer Name', room.name);
                                const newCapacity = prompt('Neue Kapazität', room.capacity);
                                updateRoom(room.id, newName, newCapacity);
                            });
                            div.appendChild(updateButton);

                            roomList.appendChild(div);
                        });
                    });
            }

            function deleteRoom(roomId) {
                fetch(`/api/rooms/${roomId}`, {
                    method: 'DELETE'
                });
            }

            function updateRoom(roomId, newName, newCapacity) {
                fetch(`/api/rooms/${roomId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: newName,
                        capacity: newCapacity
                    })
                })
                .then(response => {
                    if (response.ok) {
                        fetchRooms();
                    } else {
                        console.error('Failed to update room');
                    }
                });
            }

            fetchRooms();
        });
    </script>
</x-app-layout>