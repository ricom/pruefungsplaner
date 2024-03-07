<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'start_time', 'end_time', 'participant_count', 'exam_format_id', 'lecturer_id', 'course_id', 'room_id', 'semester_id', 'faculty_id', 'degree_id'];

    public function examFormat()
    {
        return $this->belongsTo(ExamFormat::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function supervisors()
    {
        return $this->belongsToMany(Supervisor::class);
    }
}
