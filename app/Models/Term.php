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

    /**
     * @var array
     */
    protected $appends = [
        'display_term',
        'term_season_number'
    ];

    public function getTermSeasonNumberAttribute()
    {
        return \substr((string)$this->term_id, -1);
    }

    public function getDisplayTermAttribute()
    {
       return \str_replace('-', ' ', $this->term);
    }

    public function scopeCurrentTerm($query, $today)
    {
        return $query->where('begin_date', '<=', $today)
        ->where('end_date', '>=', $today);
    }

    public function scopePreviousTerm($query, $today)
    {
        return $query->where('end_date', '<', $today)
            ->orderBy('end_date', 'desc')->take(1);
    }

    public function scopeNowAndNextTerm($query, $take = 2)
    {
        return $query->where('end_date', '>', Carbon::now())
              ->orderBy('end_date')->take($take + 1);
    }
}
