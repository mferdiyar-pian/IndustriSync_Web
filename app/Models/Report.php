<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'title',
        'type',
        'start_date',
        'end_date',
        'file_path',
    ];
}
