<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'bidding_id',
        'file_file_name',
        'file_file_size',
        'file_content_type',
        'order',
    ];
}
