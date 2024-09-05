<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biddings extends Model
{
    use HasFactory;
    // protected $guarded  = ['id'];
    // protected $dates    = ['opening'];
    protected $table    = 'biddings';
    protected $fillable = [
        'token',
        'genre_id',
        'phase_id',
        'title',
        'subtitle',
        'indentifier',
        'description',
        'object',
        'active',
        'bidding_category_id',
        'order',
        'type_id',
        'author_id',
        'type_doc',
        'opening',
        'config',
        'excluido',
        // 'reg_excluido',
        // 'deletado',
        // 'reg_deletado',
    ];
}
