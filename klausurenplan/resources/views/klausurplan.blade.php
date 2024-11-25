<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Klausurplan') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center mt-8">
            <div class="mr-8">
                <label for="faculty-select" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Fakultät
                </label>
                <select id="faculty-select" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="" disabled selected>Fakultät auswählen</option>
                    <!-- Populate dynamically -->
                </select>
            </div>
            <div>
                <label for="semester-select" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Semester
                </label>
                <select id="semester-select" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="" disabled selected>Semester auswählen</option>
                    <!-- Populate dynamically -->
                </select>
            </div>
        </div>
        <div class="mt-8">
            <div class="overflow-x-auto">
                <div id="loading" class="text-center">Loading data...</div>
                <div id="error" class="text-center text-red-500 hidden">There was an error loading the data. Please try again later.</div>
                <table class="mt-3 w-full rounded-lg overflow-hidden">
                    <thead class="bg-gray-200 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Datum</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Klausur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Raum</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Aufsichtsperson 1</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Aufsichtsperson 2</th>
                        </tr>
                    </thead>
                    <tbody id="exam-list">
                        <!-- Exams will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Caching the fetched data to prevent redundant API calls
        let examsData = null;

        // Function to fetch dropdown options
        async function fetchDropdownOptions() {
            try {
                const options = await (await fetch("/api/exams/options")).json();

                const facultySelect = document.getElementById("faculty-select");
                const semesterSelect = document.getElementById("semester-select");

                // Preselect the first faculty
                facultySelect.innerHTML = `
                    ${options.faculties.map((faculty, index) => `
                        <option value="${faculty.id}" ${index === 0 ? 'selected' : ''}>${faculty.name}</option>
                    `).join("")}
                `;

                // Preselect the semester with the highest ID
                const highestSemester = options.semesters.reduce((max, semester) => semester.id > max.id ? semester : max);
                semesterSelect.innerHTML = `
                    ${options.semesters.map(semester => `
                        <option value="${semester.id}" ${semester.id === highestSemester.id ? 'selected' : ''}>${semester.name}</option>
                    `).join("")}
                `;
            } catch (error) {
                console.error("Failed to fetch dropdown options:", error);
                throw error;
            }
        }

        // Fetch data for rooms, supervisors, and exams based on selected faculty and semester
        async function fetchData(faculty, semester) {
            try {
                const [rooms, supervisors, exams] = await Promise.all([
                    fetch("/api/rooms").then(res => res.json()),
                    fetch("/api/supervisors").then(res => res.json()),
                    (await fetch(`/api/exams/${faculty}/${semester}`)).json()
                ]);
                return { rooms, supervisors, exams };
            } catch (error) {
                console.error("Error fetching data:", error);
                throw new Error("Failed to fetch data");
            }
        }

        // Helper function to format date to DD.MM.YYYY
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString("de-DE"); // Format: DD.MM.YYYY
        }

        // Function to generate options for room and supervisor selects
        function generateOptions(options, selectedId, type = 'Room') {
            const placeholder = `${type} auswählen`;
            return `
                <option value="" disabled ${!selectedId ? 'selected' : ''}>${placeholder}</option>
                ${options.map(option => `
                    <option value="${option.id}" ${option.id === selectedId ? 'selected' : ''}>
                        ${option.name || `${option.first_name} ${option.last_name}`}
                    </option>
                `).join('')}
            `;
        }

        // Create a table row for each exam
        function createExamRow(exam, rooms, supervisors) {
            const row = document.createElement("tr");
            row.classList.add("border-b-2");

            const selectedRoomId = exam.room_id || null;
            const selectedSupervisorIdA = exam.supervisors?.[0]?.id || null;
            const selectedSupervisorIdB = exam.supervisors?.[1]?.id || null;

            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">${formatDate(exam.date)}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <b>${exam.degree?.name || 'No Degree'}</b><br>
                    ${exam.lecturer?.name || 'No Lecturer'}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <select id="RoomofExam${exam.id}" aria-label="Select Room for Exam ${exam.id}" class="w-full rounded-md border-gray-300 shadow-sm">
                        ${generateOptions(rooms, selectedRoomId, 'Raum')}
                    </select>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <select id="SupervisiorAofExam${exam.id}" aria-label="Select Supervisor A for Exam ${exam.id}" class="w-full rounded-md border-gray-300 shadow-sm">
                        ${generateOptions(supervisors, selectedSupervisorIdA, 'Aufsichtsperson 1')}
                    </select>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <select id="SupervisiorBofExam${exam.id}" aria-label="Select Supervisor B for Exam ${exam.id}" class="w-full rounded-md border-gray-300 shadow-sm">
                        ${generateOptions(supervisors, selectedSupervisorIdB, 'Aufsichtsperson 2')}
                    </select>
                </td>
            `;
            return row;
        }

        let examListChangeListenerAdded = false; // Flag to track if listener is added

        function populateExams({ rooms, supervisors, exams }) {
            const examList = document.getElementById("exam-list");

            // Clear existing rows and populate new rows
            const rows = exams.map(exam => createExamRow(exam, rooms, supervisors));
            examList.innerHTML = "";
            examList.append(...rows);

            // Ensure only one change event listener is added to exam-list
            if (!examListChangeListenerAdded) {
                examList.addEventListener("change", async (event) => {
                    if (!event.target.matches('select')) return; // Ignore non-select elements

                    const examId = event.target.id.replace(/\D/g, ''); // Extract exam ID from element's ID
                    const roomID = document.getElementById(`RoomofExam${examId}`).value;
                    const supervisorAID = document.getElementById(`SupervisiorAofExam${examId}`).value;
                    const supervisorBID = document.getElementById(`SupervisiorBofExam${examId}`).value;

                    const examData = {
                        exams: [{
                            id: examId,
                            room_id: roomID || null,
                            supervisors: [supervisorAID, supervisorBID].filter(id => id)
                        }]
                    };

                    try {
                        const response = await fetch('/api/exams', {
                            method: 'PUT',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(examData)
                        });

                        const data = await response.json();
                        if (response.ok) {
                            console.log('Exam updated:', data);
                        } else {
                            console.error('Failed to update exam:', data.error);
                        }
                    } catch (error) {
                        console.error('Network error:', error);
                    }
                });

                examListChangeListenerAdded = true; // Set the flag to true
            }
        }

        // Fetch and populate exams when dropdowns change
        async function fetchAndPopulateExams() {
            const loadingElement = document.getElementById("loading");
            const errorElement = document.getElementById("error");
            const faculty = document.getElementById("faculty-select").value;
            const semester = document.getElementById("semester-select").value;

            try {
                loadingElement.classList.remove("hidden");
                errorElement.classList.add("hidden");

                if (!faculty || !semester) {
                    throw new Error("Please select both faculty and semester.");
                }

                const { rooms, supervisors, exams } = await fetchData(faculty, semester);
                populateExams({ rooms, supervisors, exams });
                loadingElement.classList.add("hidden");
            } catch (error) {
                errorElement.classList.remove("hidden");
                loadingElement.classList.add("hidden");
                console.error("Error fetching data:", error);
            }
        }

        // Initialize page
        async function initializePage() {
            try {
                await fetchDropdownOptions();
                await fetchAndPopulateExams();
            } catch (error) {
                console.error("Error during initialization:", error);
            }
        }

        // Event listeners for dropdown changes
        document.getElementById("faculty-select").addEventListener("change", fetchAndPopulateExams);
        document.getElementById("semester-select").addEventListener("change", fetchAndPopulateExams);

        // Initialize on page load
        document.addEventListener("DOMContentLoaded", initializePage);
    </script>
</x-app-layout>
