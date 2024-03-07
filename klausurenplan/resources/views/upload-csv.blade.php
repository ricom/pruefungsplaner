<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Klausurplan hochladen') }}
        </h2>
    </x-slot>

    <!-- The form action is not directly used, but kept for semantic HTML -->
    <form id="csv-upload-form" enctype="multipart/form-data">
        @csrf <!-- CSRF token is still needed for AJAX requests from within Laravel applications -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div id="drag-drop-area" class="border border-dashed rounded-3xl h-64 mt-4 mb-4 flex justify-center items-center">
                <label class="text-center uppercase font-bold text-gray-500 text-xl">CSV Datei hier reinziehen</label>
            </div>

            <input type="file" name="file-input" id="file-input" class="mb-4 text-blue-500 font-bold" accept=".csv"/>

            <div>
                <select name="semester-season" id="semester-season" class="mb-4 font-bold">
                    <option value="Sommersemester">Sommersemester</option>
                    <option value="Wintersemester">Wintersemester</option>
                </select>

                <input type="text" name="semester-year" id="semester-year" class="mb-4 font-bold"/>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">CSV hochladen</button>
        
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const uploadButton = document.getElementById('upload-button');
            const fileInput = document.getElementById('file-input');
            const dragDropArea = document.getElementById('drag-drop-area');

            dragDropArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                dragDropArea.classList.add('drag-over');
            });

            dragDropArea.addEventListener('dragleave', (e) => {
                e.preventDefault();
                dragDropArea.classList.remove('drag-over');
            });

            dragDropArea.addEventListener('drop', (e) => {
                e.preventDefault();
                dragDropArea.classList.remove('drag-over');
                fileInput.files = e.dataTransfer.files;
            });

            uploadButton.addEventListener('click', function () {
                if (fileInput.files.length > 0) {
                    const formData = new FormData();
                    formData.append('file-input', fileInput.files[0]);
                    formData.append('semester-season', document.getElementById('semester-season').value);
                    formData.append('semester-year', document.getElementById('semester-year').value);
                    formData.append('_token', '{{ csrf_token() }}'); 

                    fetch('/api/csv', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert('File uploaded successfully');
                        console.log(data);
                        // Handle success here (e.g., displaying a success message)
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                        // Handle errors here (e.g., displaying an error message)
                    });
                } else {
                    alert('Bitte wählen Sie eine Datei aus!');
                }
            });
        });
    </script>
</x-app-layout>
