<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Aufsichtsperson hinzufügen / bearbeiten') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form id="supervisor-form" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="form-group flex">
                <div class="w-1/2 mr-2">
                    <label for="first_name" class="block text-sm font-medium text-gray-800, dark:text-gray-200">Vorname:</label>
                    <input type="text" name="first_name" id="first_name" class="w-full max-w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="w-1/2">
                    <label for="last_name" class="block text-sm font-medium text-gray-800, dark:text-gray-200">Nachname:</label>
                    <input type="text" name="last_name" id="last_name" class="w-full max-w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-gray-800, dark:text-gray-200">Email:</label>
                <input type="email" name="email" id="email" class="w-full max-w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <button id="submit-button" type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Aufsichtsperson erstellen</button>
        </form>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Aufsichtspersonen</h2>
            <div class="overflow-x-auto">
                <table class="mt-3 w-full rounded-lg overflow-hidden">
                    <thead class="bg-gray-200 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody id="supervisor-list"></tbody>
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
                        <label for="update-first-name" class="block text-sm font-medium text-gray-800, dark:text-gray-200">Vorname:</label>
                        <input type="text" id="update-first-name" name="first_name" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="update-last-name" class="block text-sm font-medium text-gray-800, dark:text-gray-200">Nachname:</label>
                        <input type="text" id="update-last-name" name="last_name" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="update-email" class="block text-sm font-medium text-gray-800, dark:text-gray-200">Email:</label>
                        <input type="email" id="update-email" name="email" class="w-full border-gray-300 rounded-md shadow-sm" required>
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
            const form = document.getElementById('supervisor-form');
            const updateForm = document.getElementById('update-form');
            const modal = document.getElementById('modal');
            const closeModal = document.getElementById('close-modal');

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
                    fetchSupervisors(); // Fetch supervisors again to update the list
                })
                .catch(error => {
                    alert('Fehler beim Erstellen der Aufsichtsperson.');
                    console.error('Error creating supervisor:', error);
                });
            });

            updateForm.addEventListener('submit', function (event) {
                event.preventDefault();
                const id = document.getElementById('update-id').value;
                const formData = new FormData(updateForm);

                fetch(`/api/supervisors/${id}`, {
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
                    closeModal.click();
                    fetchSupervisors();
                })
                .catch(error => {
                    alert('Fehler beim Aktualisieren der Aufsichtsperson.');
                    console.error('Error updating supervisor:', error);
                });
            });

            closeModal.addEventListener('click', function () {
                modal.classList.add('hidden');
            });

            function openModal(supervisor) {
                document.getElementById('update-id').value = supervisor.id;
                document.getElementById('update-first-name').value = supervisor.firstName;
                document.getElementById('update-last-name').value = supervisor.lastName;
                document.getElementById('update-email').value = supervisor.email;

                modal.classList.remove('hidden');
            }

            function fetchSupervisors() {
                fetch('/api/supervisors')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(supervisors => {
                    const supervisorList = document.getElementById('supervisor-list');
                    supervisorList.innerHTML = ''; // Clear existing list
                    supervisors.forEach(supervisor => {
                        const supervisorRow = createSupervisorRow(supervisor.id, supervisor.first_name, supervisor.last_name, supervisor.email);
                        supervisorList.appendChild(supervisorRow);
                    });
                })
                .catch(error => {
                    console.error('Error fetching supervisors:', error);
                });
            }

            function createSupervisorRow(id, first_name, last_name, email) {
                const supervisorRow = document.createElement('tr');
                supervisorRow.classList.add('border-b-2')

                const nameCell = document.createElement('td');
                nameCell.textContent = `${first_name} ${last_name}`;
                nameCell.classList.add('px-6', 'w-1/4', 'py-4', 'whitespace-nowrap', 'text-sm', 'text-gray-800', 'dark:text-gray-200');

                const emailCell = document.createElement('td');
                emailCell.textContent = email;
                emailCell.classList.add('px-6', 'w-3/4', 'py-4', 'whitespace-nowrap', 'text-sm', 'text-gray-800', 'dark:text-gray-200');

                const actionsCell = document.createElement('td');
                actionsCell.classList.add('px-6', 'py-4', 'whitespace-nowrap', 'items-center', 'text-sm', 'text-white-900');

                const updateButton = document.createElement('button');
                updateButton.textContent = 'Bearbeiten';
                updateButton.classList.add('px-4', 'py-2', 'bg-blue-500', 'text-white', 'rounded-md', 'mr-2');
                updateButton.addEventListener('click', function() {
                    openModal({ id, firstName: first_name, lastName: last_name, email });
                });

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Löschen';
                deleteButton.classList.add('px-4', 'py-2', 'bg-red-500', 'text-white', 'rounded-md');
                deleteButton.addEventListener('click', function() {
                    deleteSupervisor(id);
                });

                actionsCell.appendChild(updateButton);
                actionsCell.appendChild(deleteButton);

                supervisorRow.appendChild(nameCell);
                supervisorRow.appendChild(emailCell);
                supervisorRow.appendChild(actionsCell);

                return supervisorRow;
            }

            function deleteSupervisor(id) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`/api/supervisors/${id}`, {
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
                    alert('Aufsichtsperson wurde gelöscht.');
                    fetchSupervisors();
                })
                .catch(error => {
                    alert('Fehler beim Löschen der Aufsichtsperson: ' + error.message);
                    console.error('Error deleting supervisor:', error);
                    fetchSupervisors();
                });
            }

            fetchSupervisors();
        });
    </script>
</x-app-layout>
