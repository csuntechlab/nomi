<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadPermission extends Model
{
    protected $fillable = ['user_id'];
}
