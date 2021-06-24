<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'uuid',
        'student_code',
        'student_name',
        'course_name',
        'course_enddate',
        'qr_image',
        'qr_url',
        'qr_file',
        'status'
    ];

    protected $hidden = [];

    public function setStudentNameAttribute($value)
    {
        $this->attributes['student_name'] = trim($value);
    }

    public function getCourseEnddatePeAttribute()
    {
        //return date('m/d/Y', strtotime($this->attributes['course_enddate']));
        return Carbon::parse($this->attributes['course_enddate'])
            ->locale('es_PE')
            ->isoFormat('LL');
    }

    /* public function setCourseEnddateAttribute($value)
    {
        $this->attribute['course_enddate'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    } */
}
