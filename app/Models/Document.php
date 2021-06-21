<?php

namespace App\Models;

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
}
