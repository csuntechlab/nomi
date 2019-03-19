<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $table = 'omar.terms';
    public $incrementing = false;
    public $primaryKey = 'term_id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function scopeCurrentTerm($query, $today)
    {
        return $query->where('begin_date', '<=', $today)
        ->where('end_date', '>=', $today);
    }

    public function scopeNowAndNextTerm($query, $take = 2)
    {
        return $query->where('end_date', '>', Carbon::now())
              ->orderBy('end_date')->take($take + 1);
    }
}
