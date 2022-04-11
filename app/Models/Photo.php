<?php

namespace App\Models;

use App\Http\Resources\Media\PhotoResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    const PATH_RESOURCE = PhotoResource::class;
    use HasFactory;

    protected $fillable = [
        'path',
        'name',
        'format'
    ];

}
