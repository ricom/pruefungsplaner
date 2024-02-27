<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Klausurplan hochladen') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div id="drag-drop-area" class="border border-dashed rounded-3xl border-2 h-64 mt-4 mb-4 flex justify-center items-center">

            <label class="text-center uppercase font-bold text-gray-500 text-xl">CSV Datei hier reinziehen</label>

        </div>

        <div class="flex place-content-between">

            <input type="file" id="file-input" class="mb-4 text-blue-500 font-bold"/>

            <button type="submit" id="upload-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4">Absenden</button>

        </div>
    </div>

    <script>
        const dragDropArea = document.getElementById('drag-drop-area');
        const fileInput = document.getElementById('file-input');
        const uploadButton = document.getElementById('upload-button');

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

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                dragDropArea.classList.add('file-selected');
            } else {
                dragDropArea.classList.remove('file-selected');
            }
        });

        uploadButton.addEventListener('click', () => {
            if (fileInput.files.length > 0) {
                // Perform file upload logic here
            } else {
                alert('Bitte wählen sie eine Datei aus!');
            }
        });
    </script>
</x-app-layout>
