<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassInstructors extends Model
{
    protected $table = 'class_instructors';
    protected $fillable = [
      'classes_id',
      'term_id',
      'term',
      'class_number',
      'user_id',
    ];

    public function scopeUserId($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
