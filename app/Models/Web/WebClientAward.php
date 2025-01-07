<?php

namespace App\Models\Web;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class WebClientAward extends BaseModel
{
    protected $fillable = ['created_at', 'updated_at', 'created_by', 'last_updated_by', 'title',
        'image_name', 'link', 'rank', 'status'];
}
