<?php

declare(strict_types=1);

namespace CSUNMetaLab\Support\Models;

use Illuminate\Database\Eloquent\Model;

class SupportSubmission extends Model
{
    protected $table = 'support_submissions';

    protected $primaryKey = 'submission_id';

    protected $fillable = [
        'application_name',
        'user_id',
        'impact',
        'content',
    ];
}
