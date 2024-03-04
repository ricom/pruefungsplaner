<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Degree;
use App\Models\Exam;
use App\Models\ExamFormat;
use App\Models\Faculty;
use App\Models\Lecturer;
use App\Models\Room;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Log;

class CsvUploadController extends Controller
{
    public function uploadCsv(Request $request)
    {
        $file = $request->file('csv_file');

        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        if ($file) {
            $data = array_map('str_getcsv', file($file->getRealPath()));
            
            if (count($data) > 0) {
                $header = array_shift($data);

                // might alrdy need to add logic here to assign rooms and stuff idk
                foreach ($data as $row) {
                    try {
                        $course     = Course::firstOrCreate(['name' => $row[1], 'number' => $row[0]]);
                        $lecturer   = Lecturer::firstOrCreate(['name' => $row[2]]);
                        $examFormat = ExamFormat::firstOrCreate(['name' => $row[6]]);
                        $degree     = Degree::firstOrCreate(['name' => $row[7]]);
                        $faculty    = Faculty::firstOrCreate(['name' => $row[8]]);
                        // $semester   = Semester::firstOrCreate(['name' => $row[9]]);

                        $exam       = Exam::firstOrCreate(
                            [
                                'course_id'     => $course->id,
                                // 'semester_id' => semester muss bei upload mit übergeben werden
                                'degree_id'     => $degree->id,
                                'faculty_id'    => $faculty->id
                            ],
                            [
                                'date'              => $row[3],
                                'start_time'        => $row[4],
                                'end_time'          => $row[5],
                                'exam_format_id'    => $examFormat->id,
                                'lecturer_id'       => $lecturer->id,
                                'course_id'         => $course->id,
                                'semester_id'       => 1, // wrong
                                'faculty_id'        => $faculty->id,
                                'degree_id'         => $degree->id,
                            ]
                        );

                    } catch (\Exception $e) {
                        Log::error("Failed to import row: " . $e->getMessage());
                    }
                }

                return back()->with('success', 'CSV data has been uploaded and processed.');
            }
        }

        return back()->with('error', 'Please upload a valid CSV file.');
    }
}
