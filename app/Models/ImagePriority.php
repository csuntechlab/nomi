<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;

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
