<?php

declare(strict_types=1);

namespace App\Models;

use CSUNMetaLab\Authentication\MetaUser;
use Illuminate\Notifications\Notifiable;

class User extends MetaUser
{
    public $incrementing = false;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $appends = [
        'email_uri',
        'image'
    ];

    public function getEmailUriAttribute()
    {
        return \substr($this->email, 0, \strpos($this->email, '@'));
    }

    public function getImageAttribute()
    {
        return env('MEDIA_URL') . 'faculty/media/' . $this->email_uri . '/avatar?source=true';
    }

    public function imagePriority()
    {
        return $this->hasOne('App\Models\ImagePriority', 'student_id', 'user_id');
    }
}
