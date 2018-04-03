<?php

declare(strict_types=1);

namespace App\Models;

use CSUNMetaLab\Authentication\MetaUser;
use Illuminate\Notifications\Notifiable;

class User extends MetaUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $incrementing = false;

    protected $primaryKey = 'user_id';

    public function imagePriority()
    {
        return $this->hasOne('App\Models\ImagePriority', 'student_id', 'user_id');
    }
}
