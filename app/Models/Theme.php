<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'theme';
    protected $fillable = ['user_id', 'theme'];
    public $incrementing = false;
    public $primaryKey = 'user_id';
}
