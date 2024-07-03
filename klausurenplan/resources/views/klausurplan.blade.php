<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Klausurplan') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8">
            <div class="overflow-x-auto">
                <table class="mt-3 w-full rounded-lg overflow-hidden">
                    <thead class="bg-gray-200 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Datum</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Klausur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Raum</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Kapazität</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Aufsichtsperson 1</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Aufsichtsperson 2</th>
                        </tr>
                    </thead>
                    <tbody id="exam-list">
                        <tr class="border-b-2">
                            <td class="px-6 py-4 whitespace-nowrap">14.07.24</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <b>Mathematik 2</b><br>
                                <small>Ute Karabek</small>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">H204</option>
                                    <option value="2">H304</option>
                                    <option value="3">H404</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">420</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b-2">
                            <td class="px-6 py-4 whitespace-nowrap">14.07.24</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <b>Mathematik 2</b><br>
                                <small>Ute Karabek</small>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">H204</option>
                                    <option value="2">H304</option>
                                    <option value="3">H404</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">? / 175</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b-2">
                            <td class="px-6 py-4 whitespace-nowrap">14.07.24</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <b>Mathematik 2</b><br>
                                <small>Ute Karabek</small>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">H204</option>
                                    <option value="2">H304</option>
                                    <option value="3">H404</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">140 / 175</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b-2">
                            <td class="px-6 py-4 whitespace-nowrap">14.07.24</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <b>Mathematik 2</b><br>
                                <small>Ute Karabek</small>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">H204</option>
                                    <option value="2">H304</option>
                                    <option value="3">H404</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">420</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b-2">
                            <td class="px-6 py-4 whitespace-nowrap">14.07.24</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <b>Mathematik 2</b><br>
                                <small>Ute Karabek</small>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">H204</option>
                                    <option value="2">H304</option>
                                    <option value="3">H404</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">420</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b-2">
                            <td class="px-6 py-4 whitespace-nowrap">14.07.24</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <b>Mathematik 2</b><br>
                                <small>Ute Karabek</small>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">H204</option>
                                    <option value="2">H304</option>
                                    <option value="3">H404</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">420</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b-2">
                            <td class="px-6 py-4 whitespace-nowrap">14.07.24</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <b>Mathematik 2</b><br>
                                <small>Ute Karabek</small>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">H204</option>
                                    <option value="2">H304</option>
                                    <option value="3">H404</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">420</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b-2">
                            <td class="px-6 py-4 whitespace-nowrap">14.07.24</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <b>Mathematik 2</b><br>
                                <small>Ute Karabek</small>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">H204</option>
                                    <option value="2">H304</option>
                                    <option value="3">H404</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">420</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="aufsichtsperson1" id="aufsichtsperson1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Aufsichtsperson 1</option>
                                    <option value="2">Aufsichtsperson 2</option>
                                    <option value="3">Aufsichtsperson 3</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>

        function fetchExams() {
            fetch('/api/exams')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(exams => {
                const examList = document
                console.log(exams);
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
        }

        fetchExams();

    </script>

</x-app-layout>
