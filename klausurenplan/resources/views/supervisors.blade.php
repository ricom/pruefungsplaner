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
                    <label for="name" class="block text-sm font-medium text-gray-300">Vorname:</label>
                    <input type="text" name="first_name" id="name" class="w-full max-w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="w-1/2">
                    <label for="lastname" class="block text-sm font-medium text-gray-300">Nachname:</label>
                    <input type="text" name="last_name" id="lastname" class="w-full max-w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-gray-300">Email:</label>
                <input type="email" name="email" id="email" class="w-full max-w-full border-gray-300 rounded-md shadow-sm">
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
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    alert('Aufsichtsperson wurde erfolgreich erstellt.');
                    form.reset();
                    fetchSupervisors(); // Fetch supervisors again to update the list
                })
                .catch(error => {
                    alert('Fehler beim Erstellen der Aufsichtsperson.');
                    console.error('Error creating supervisor:', error);
                });
            });

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
                    //  Optionally display an error message to the user
                });
            }

            function createSupervisorRow(id, first_name, last_name, email) {
                const supervisorRow = document.createElement('tr');

                const nameCell = document.createElement('td');
                nameCell.textContent = `${first_name} ${last_name}`;
                nameCell.classList.add('px-6', 'w-1/4', 'py-4', 'whitespace-nowrap', 'text-sm', 'text-white');

                const emailCell = document.createElement('td');
                emailCell.textContent = email;
                emailCell.classList.add('px-6', 'w-3/4', 'py-4', 'whitespace-nowrap', 'text-sm', 'text-white');

                const actionsCell = document.createElement('td');
                actionsCell.classList.add('px-6', 'py-4', 'whitespace-nowrap', 'items-ste', 'text-sm', 'text-white-900');

                const updateButton = document.createElement('button');
                updateButton.textContent = 'Bearbeiten';
                updateButton.classList.add('px-4', 'py-2', 'bg-blue-500', 'text-white', 'rounded-md', 'mr-2');
                updateButton.addEventListener('click', function() {
                    // Show Modal with form to update supervisor
                });

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Löschen';
                deleteButton.classList.add('px-4', 'py-2', 'bg-red-500', 'text-white', 'rounded-md');
                deleteButton.addEventListener('click', function() {
                    deleteSupervisor(id);
                    fetchSupervisors();
                });

                actionsCell.appendChild(updateButton);
                actionsCell.appendChild(deleteButton);

                supervisorRow.appendChild(nameCell);
                supervisorRow.appendChild(emailCell);
                supervisorRow.appendChild(actionsCell);

                return supervisorRow;
            }

            // TODO: implement the model functionality to update a supervisor

            function updateSupervisor(id, formData) {
                fetch(`/api/supervisors/${id}`, {
                    method: 'UPDATE',
                    body: formData
                }).then(response => {
                    fetchSupervisors(); // Fetch supervisors again to update the list
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    alert('Aufsichtsperson wurde aktualisiert.');
                }).catch(error => {
                    alert('Fehler beim Aktualisieren der Aufsichtsperson.');
                    console.error('Error updating supervisor:', error);
                });
            }

            function deleteSupervisor(id) {
                fetch(`/api/supervisors/${id}`, {
                    method: 'DELETE',
                }).then(response => {
                    fetchSupervisors(); // Fetch supervisors again to update the list
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    alert('Aufsichtsperson wurde gelöscht.');
                }).catch(error => {
                    alert('Fehler beim Löschen der Aufsichtsperson.');
                    console.error('Error deleting supervisor:', error);
                });
            }

            fetchSupervisors(); // Fetch supervisors when the page loads
        });
    </script>
</x-app-layout>
