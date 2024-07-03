<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Raum erstellen / bearbeiten') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form id="room-form" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="form-group flex">
                <div class="w-1/2 mr-2">
                    <label for="name" class="block text-sm font-medium text-gray-300">Raumbezeichnung:</label>
                    <input type="text" name="name" id="name" required class="w-full max-w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="w-1/2">
                    <label for="capacity" class="block text-sm font-medium text-gray-300">Kapazität:</label>
                    <input type="number" name="capacity" id="capacity" required class="w-full max-w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

            <button id="submit-button" type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Raum hinzufügen</button>
        </form>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Räume</h2>
            <div class="overflow-x-auto">
                <table class="mt-3 w-full rounded-lg overflow-hidden">
                    <thead class="bg-gray-200 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Raum</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Kapazität</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody id="room-list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="update-form" class="space-y-4 p-6">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="update-id" name="id">
                    <div class="form-group">
                        <label for="update-name" class="block text-sm font-medium text-gray-700">Raumbezeichung:</label>
                        <input type="text" id="update-name" name="name" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="update-capacity" class="block text-sm font-medium text-gray-700">Kapazität:</label>
                        <input type="number" id="update-capacity" name="capacity" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" id="close-modal" class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Abbrechen</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Aktualisieren</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('room-form');
            const updateForm = document.getElementById('update-form');
            const modal = document.getElementById('modal');
            const closeModal = document.getElementById('close-modal');

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const formData = new FormData(form);

                fetch('/api/rooms', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(error => {
                            throw new Error(error.message || 'Network response was not ok');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    form.reset();
                    fetchRooms(); // Fetch rooms again to update the list
                })
                .catch(error => {
                    alert('Fehler beim Erstellen des Raumes.');
                    console.error('Error creating room:', error);
                });
            });

            updateForm.addEventListener('submit', function (event) {
                event.preventDefault();
                const id = document.getElementById('update-id').value;
                const formData = new FormData(updateForm);

                fetch(`/api/rooms/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(error => {
                            throw new Error(error.message || 'Network response was not ok');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    updateForm.reset();
                    modal.classList.add('hidden');
                    fetchRooms();
                })
                .catch(error => {
                    alert('Fehler beim Aktualisieren des Raumes.');
                    console.error('Error updating room:', error);
                });
            });

            closeModal.addEventListener('click', function () {
                modal.classList.add('hidden');
            });

            function openModal(room) {
                document.getElementById('update-id').value = room.id;
                document.getElementById('update-name').value = room.name;
                document.getElementById('update-capacity').value = room.capacity;

                modal.classList.remove('hidden');
            }

            function fetchRooms() {
                fetch('/api/rooms')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(rooms => {
                    const roomList = document.getElementById('room-list');
                    roomList.innerHTML = ''; // Clear existing list
                    rooms.forEach(room => {
                        const roomRow = createRoomRow(room);
                        roomList.appendChild(roomRow);
                    });
                })
                .catch(error => {
                    console.error('Error fetching rooms:', error);
                });
            }

            function createRoomRow(room) {
                const roomRow = document.createElement('tr');

                const nameCell = document.createElement('td');
                nameCell.textContent = room.name;
                nameCell.classList.add('px-6', 'w-1/4', 'py-4', 'whitespace-nowrap', 'text-sm', 'text-white');

                const capacityCell = document.createElement('td');
                capacityCell.textContent = room.capacity;
                capacityCell.classList.add('px-6', 'w-3/4', 'py-4', 'whitespace-nowrap', 'text-sm', 'text-white');

                const actionsCell = document.createElement('td');
                actionsCell.classList.add('px-6', 'py-4', 'whitespace-nowrap', 'items-center', 'text-sm', 'text-white-900');

                const updateButton = document.createElement('button');
                updateButton.textContent = 'Bearbeiten';
                updateButton.classList.add('px-4', 'py-2', 'bg-blue-500', 'text-white', 'rounded-md', 'mr-2');
                updateButton.addEventListener('click', function() {
                    openModal(room);
                });

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Löschen';
                deleteButton.classList.add('px-4', 'py-2', 'bg-red-500', 'text-white', 'rounded-md');
                deleteButton.addEventListener('click', function() {
                    deleteRoom(room.id);
                });

                actionsCell.appendChild(updateButton);
                actionsCell.appendChild(deleteButton);

                roomRow.appendChild(nameCell);
                roomRow.appendChild(capacityCell);
                roomRow.appendChild(actionsCell);

                return roomRow;
            }

            function deleteRoom(id) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`/api/rooms/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(error => {
                            throw new Error(error.message || 'Network response was not ok');
                        });
                    }
                    // Handle 204 No Content separately
                    if (response.status === 204) {
                        return null;
                    }
                    return response.json();
                })
                .then(data => {
                    alert('Raum wurde gelöscht.');
                    fetchRooms();
                })
                .catch(error => {
                    alert('Fehler beim Löschen des Raumes: ' + error.message);
                    console.error('Error deleting room:', error);
                    fetchRooms();
                });
            }

            fetchRooms();
        });
    </script>
</x-app-layout>
