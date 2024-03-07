<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Degree;
use App\Models\Exam;
use App\Models\ExamFormat;
use App\Models\Faculty;
use App\Models\Lecturer;
use App\Models\Room;
use App\Models\Semester;
use App\Models\Supervisor;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::all();
        return response()->json($exams);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $file = $request->file('file-input');

            $request->validate([
                'file-input' => 'required|file|mimes:csv,txt',
            ]);

            $semesterSeason = $request->input('semester-season');
            $semesterYear = $request->input('semester-year');
            $semesterValue = $semesterSeason . ' ' . $semesterYear;

            if (!$file) {
                return response()->json(['error' => 'No file uploaded.'], 400);
            }

            $data = array_map('str_getcsv', file($file->getRealPath()));

            if (count($data) <= 0) {
                return response()->json(['error' => 'CSV file is empty.'], 400);
            }

            $header = array_shift($data);

            foreach ($data as $row) {
                $course = Course::firstOrCreate(['name' => $row[1], 'number' => $row[0]]);
                $lecturer = Lecturer::firstOrCreate(['name' => $row[2]]);
                $examFormat = ExamFormat::firstOrCreate(['name' => $row[6]]);
                $degree = Degree::firstOrCreate(['name' => $row[7]]);
                $faculty = Faculty::firstOrCreate(['name' => $row[8]]);
                $semester = Semester::firstOrCreate(['name' => $semesterValue]);

                $examData = [
                    'date' => $row[3],
                    'start_time' => $row[4],
                    'end_time' => $row[5],
                    'exam_format_id' => $examFormat->id,
                    'lecturer_id' => $lecturer->id,
                    'course_id' => $course->id,
                    'semester_id' => $semester->id,
                    'faculty_id' => $faculty->id,
                    'degree_id' => $degree->id,
                ];

                $exam = Exam::firstOrCreate(
                    [
                        'course_id' => $course->id,
                        'semester_id' => $semester->id,
                        'degree_id' => $degree->id,
                        'faculty_id' => $faculty->id,
                    ],
                    $examData
                );
            }

            return response()->json(['success' => 'CSV data has been uploaded and processed.'], 200);
        } catch (\Exception $e) {
            Log::error("Failed to process CSV upload: " . $e->getMessage());
            return response()->json(['error' => 'Failed to process CSV upload.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty, Semester $semester)
    {
        return response()->json(Exam::where('faculty_id', $faculty->id)->where('semester_id', $semester->id)->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Start a transaction to ensure data integrity
        DB::beginTransaction();
        
        try {
            // Validate the overall structure of the request data, making room_id and supervisors optional
            $examsData = $request->validate([
                'exams' => 'required|array',
                'exams.*.id' => 'required|exists:exams,id',
                'exams.*.room_id' => 'sometimes|nullable|exists:rooms,id',
                'exams.*.supervisors' => 'sometimes|nullable|array',
                'exams.*.supervisors.*' => 'nullable|exists:supervisors,id',
            ]);

            foreach ($examsData['exams'] as $examData) {
                $exam = Exam::findOrFail($examData['id']);

                // Update room_id if provided
                if (array_key_exists('room_id', $examData)) {
                    $exam->room_id = $examData['room_id'];
                }

                $exam->save();

                // If supervisors data is provided, sync the supervisors, otherwise detach if null is explicitly provided
                if (array_key_exists('supervisors', $examData)) {
                    if (is_null($examData['supervisors'])) {
                        // If supervisors are explicitly set to null, detach all existing relationships
                        $exam->supervisors()->detach();
                    } else {
                        // Otherwise, sync the provided supervisor IDs
                        $exam->supervisors()->sync($examData['supervisors']);
                    }
                }
            }

            // Commit the transaction
            DB::commit();
            
            return response()->json(['success' => 'Exams updated successfully.'], 200);
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while updating the exams: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exams)
    {
        $exams->delete();
        return response()->json(null, 204);
    }
}
