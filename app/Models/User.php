<?php

declare(strict_types=1);

namespace App\Models;

use CSUNMetaLab\Authentication\MetaUser;
use Illuminate\Notifications\Notifiable;

class User extends MetaUser
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public $incrementing = false;

    protected $primaryKey = 'user_id';

    public function imagePriority()
    {
        return $this->hasOne('App\Models\ImagePriority', 'student_id', 'user_id');
    }
}
