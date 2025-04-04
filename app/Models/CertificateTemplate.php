<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateTemplate extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'certificate', 'student_photo', 'template', 'background_image','custom_css', 'print_institute_head','background_status', 'public_verify', 'status'];
}
