<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Traits\HasCompositePrimaryKey;

class ImagePriority extends Model
{
    use HasCompositePrimaryKey;

    protected $primaryKey = ['user_id', 'student_id'];

    protected $table = 'image_priority';
    protected $fillable = [
        'user_id',
        'student_id',
        'image_priority',
    ];
    public $incrementing = false;
}
