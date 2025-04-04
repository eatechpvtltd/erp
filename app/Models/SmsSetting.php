<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsSetting extends BaseModel
{
    protected $fillable = ['created_at', 'updated_at', 'identity', 'logo', 'link', 'config', 'sorting', 'status'];
}
