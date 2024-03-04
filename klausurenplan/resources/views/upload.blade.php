<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- resources/views/upload.blade.php --}}
        </h2>
    </x-slot>
    
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="block mb-8">
            <h1 class="text-2xl font-bold text-gray-700 dark:text-white">Upload a CSV File</h1>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{ route('csv.form') }}" method="POST" enctype="multipart/form-data" class="shadow sm:rounded-md sm:overflow-hidden">
                @csrf
                <div class="px-4 py-5 bg-white dark:bg-gray-800 space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                CSV file
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="file" name="csv_file" accept=".csv" required class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Upload
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8">
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Semesters</h3>
            <ul class="mt-3 max-w-2xl text-sm text-gray-500 dark:text-gray-300">
                @foreach($semesters as $semester)
                    <li class="mt-2 flex items-start">
                        <span class="ml-2">{{ $semester->name }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
