<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $table = 'omar.terms';
    public $incrementing = false;
    public $primaryKey = 'term_id';
}
