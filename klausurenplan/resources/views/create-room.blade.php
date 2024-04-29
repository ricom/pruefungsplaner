<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Raum erstellen / bearbeiten') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Form for creating a new room -->
        <form id="create-room-form" class="space-y-4">
            @csrf
            <div class="flex space-x-4 justify-between items-end">
                <div class="w-5/12">
                    <label for="name" class="block text-sm font-medium text-gray-300">Raumbezeichnung:</label>
                    <input type="text" name="name" id="name" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="w-5/12">
                    <label for="capacity" class="block text-sm font-medium text-gray-300">Kapazität:</label>
                    <input type="number" name="capacity" id="capacity" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Raum hinzufügen</button>
                </div>
            </div>
        </form>
    </div>
    <!-- Container for listing rooms -->
    <div id="rooms-list" class="mt-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h3 class="text-lg font-medium leading-6 text-gray-300">Verfügbare Räume</h3>
        <div class="mt-3 text-sm text-gray-500 flex flex-col" id="room-list"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let currentUpdateForm = null;

            // Function to close the current update form
            function closeUpdateForm() {
                if (currentUpdateForm) {
                    currentUpdateForm.remove(); // Remove the current update form
                    currentUpdateForm = null; // Reset the reference
                }
            }

            // Function to update room details
            function updateRoom(roomId, formData) {
                fetch(`/api/rooms/${roomId}`, {
                    method: 'PUT',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(() => {
                    fetchRooms();
                    closeUpdateForm(); // Close the update form after successful update
                })
                .catch(error => {
                    console.error('Error updating room:', error);
                    // Optionally display an error message to the user
                });
            }

            // Function to delete a room
            function deleteRoom(roomId) {
                fetch(`/api/rooms/${roomId}`, {
                    method: 'DELETE'
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(() => {
                    fetchRooms();
                    closeUpdateForm(); // Close the update form after successful delete
                })
                .catch(error => {
                    console.error('Error deleting room:', error);
                    // Optionally display an error message to the user
                });
            }

            // Function to handle room update form submission
            function handleUpdateFormSubmission(event, roomId) {
                event.preventDefault();
                const formData = new FormData(event.target);
                updateRoom(roomId, formData);
            }

            // Function to create update form for a room
            function createUpdateForm(room_name, room_capacity, room_id) {
                // Function to create input element
                function createInput(type, name, placeholder, value, required) {
                    const input = document.createElement('input');
                    input.setAttribute('type', type);
                    input.setAttribute('name', name);
                    input.setAttribute('placeholder', placeholder);
                    if (value) {
                        input.setAttribute('value', value);
                    }
                    if (required) {
                        input.setAttribute('required', true);
                    }
                    input.classList.add('mt-1', 'focus:ring-indigo-500', 'focus:border-indigo-500', 'block', 'w-full', 'shadow-sm', 'sm:text-sm', 'border-gray-300', 'rounded-md');
                    return input;
                }

                const form = document.createElement('form');
                form.classList.add('flex', 'space-x-4', 'justify-between', 'items-end', 'w-full', 'mt-4');
                form.addEventListener('submit', event => handleUpdateFormSubmission(event, room_id)); // Submit handler

                const nameInput = createInput('text', 'name', 'Neue Raumbezeichnung', room_name, true);
                const capacityInput = createInput('number', 'capacity', 'Neue Kapazität', room_capacity, true);

                const updateButton = document.createElement('button');
                updateButton.textContent = 'Aktualisieren';
                updateButton.classList.add('px-4', 'py-2', 'bg-blue-500', 'text-white', 'rounded-md', 'hover:bg-blue-600');

                form.appendChild(nameInput);
                form.appendChild(capacityInput);
                form.appendChild(updateButton);

                return form;
            }

            // Function to create room div
            function createRoomDiv(room_name, room_capacity, room_id) {
                const div = document.createElement('div');
                div.classList.add('flex', 'items-center', 'border-b', 'border-gray-200', 'py-2', 'justify-between', 'text-sm');

                const roomDetails = document.createElement('div');
                roomDetails.innerHTML = `<span class="font-bold text-white">${room_name}</span> (Kapazität: <span class="font-bold">${room_capacity}</span>)`;

                const buttonContainer = document.createElement('div');
                buttonContainer.classList.add('flex');

                const updateButton = document.createElement('button');
                updateButton.textContent = 'Update';
                updateButton.classList.add('px-4', 'py-2', 'bg-blue-500', 'text-white', 'rounded-md', 'hover:bg-blue-600');
                updateButton.addEventListener('click', () => {
                    closeUpdateForm(); // Close any open update form
                    const updateForm = createUpdateForm(room_name, room_capacity, room_id);
                    div.innerHTML = ''; // Clear div content
                    div.appendChild(updateForm); // Append update form
                    currentUpdateForm = updateForm; // Set the current update form reference
                });

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Delete';
                deleteButton.classList.add('px-4', 'py-2', 'bg-red-500', 'text-white', 'rounded-md', 'hover:bg-red-600', 'ml-2');
                deleteButton.addEventListener('click', () => {
                    deleteRoom(room_id);
                });

                buttonContainer.appendChild(updateButton);
                buttonContainer.appendChild(deleteButton);

                div.appendChild(roomDetails);
                div.appendChild(buttonContainer);

                return div;
            }

            // Fetch all rooms and display them
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
                        roomList.innerHTML = '';
                        rooms.forEach(room => {
                            const div = createRoomDiv(room.name, room.capacity, room.id);
                            roomList.appendChild(div);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching rooms:', error);
                        // Optionally display an error message to the user
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
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(room => {
                    fetchRooms();
                    this.reset();
                })
                .catch(error => {
                    console.error('Error creating room:', error);
                    // Optionally display an error message to the user
                });
            });

            // Fetch rooms on page load
            fetchRooms();
        });
    </script>
</x-app-layout>
