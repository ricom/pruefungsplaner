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

async function fetchAndPopulateExams() {
    const examList = document.getElementById("exam-list");

    try {
        // Fetch data concurrently
        const [rooms, supervisors, exams] = await Promise.all([
            fetch("/api/rooms").then(res => res.json()),
            fetch("/api/supervisors").then(res => res.json()),
            fetch("/api/exams").then(res => res.json())
        ]);

        // Generate room options with a default placeholder
        const generateRoomOptions = (selectedRoomId) => `
            <option value="" disabled ${!selectedRoomId ? 'selected' : ''}>Raum auswählen</option>
            ${rooms.map(room => `
                <option value="${room.id}" ${room.id === selectedRoomId ? 'selected' : ''}>${room.name}</option>
            `).join("")}
        `;

        // Generate supervisor options with a default placeholder
        const generateSupervisorOptions = (selectedSupervisorId) => `
            <option value="Null" disabled ${!selectedSupervisorId ? 'selected' : ''}>Aufsichtsperson auswählen</option>
            ${supervisors.map(supervisor => `
                <option value="${supervisor.id}" ${supervisor.id === selectedSupervisorId ? 'selected' : ''}>
                    ${supervisor.first_name} ${supervisor.last_name}
                </option>
            `).join("")}
        `;

        // Clear existing rows in the table
        examList.innerHTML = "";

        // Populate exams into the table
        exams.forEach(exam => {
            const row = document.createElement("tr");
            row.classList.add("border-b-2");

            // Extract nested data with fallback
            const examID = exam.id;
            const lecturerName = exam.lecturer?.name || 'No Lecturer';
            const examFormatName = exam.exam_format?.name || 'No Exam Format';
            const degreeName = exam.degree?.name || 'No Degree';
            const selectedRoomId = exam.room_id || null;
            const selectedSupervisorIdA = exam.supervisors?.[0]?.id || null;
            const selectedSupervisorIdB = exam.supervisors?.[1]?.id || null;

            console.log(examID);


            // Create a table row for the exam
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">${formatDate(exam.date)}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <b>${degreeName}</b><br>
                    ${lecturerName}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <select id="RoomofExam${examID}" class="w-full rounded-md border-gray-300 shadow-sm">
                        ${generateRoomOptions(selectedRoomId)}
                    </select>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <select id="SupervisiorAofExam${examID}" class="w-full rounded-md border-gray-300 shadow-sm">
                        ${generateSupervisorOptions(selectedSupervisorIdA)}
                    </select>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <select id="SupervisiorBofExam${examID}" class="w-full rounded-md border-gray-300 shadow-sm">
                        ${generateSupervisorOptions(selectedSupervisorIdB)}
                    </select>
                </td>
            `;

            row.addEventListener("change", async (event) => {
                const roomID = document.getElementById(`RoomofExam${examID}`).value;
                const supervisorAID = document.getElementById(`SupervisiorAofExam${examID}`).value;
                const supervisorBID = document.getElementById(`SupervisiorBofExam${examID}`).value;

                console.log(roomID, supervisorAID, supervisorBID);
            });

            // Append the row to the table
            examList.appendChild(row);
        });
    } catch (error) {
        console.error("Error fetching data:", error);
    }
}

// Helper: Format Date
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString("de-DE"); // Format: DD.MM.YYYY
}

// Call the function on page load
fetchAndPopulateExams();


</script>

</x-app-layout>
