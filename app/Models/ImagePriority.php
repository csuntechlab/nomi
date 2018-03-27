<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagePriority extends Model
{
    protected $table = 'image_priority';
    protected $fillable = ['image_priority'];
    protected $primaryKey = 'image_priority';
    public $incrementing = false;
}
