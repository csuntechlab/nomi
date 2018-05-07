<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Note extends Model
{
    protected $fillable = ['student_id', 'user_id', 'notepad'];

    protected function setNotepadAttribute($value)
    {
        return Crypt::encrypt($value);
    }

    protected function getNotepadAttribute($value)
    {
        return Crypt::decrypt($value);
    }
}
