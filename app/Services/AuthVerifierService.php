<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\AuthVerifierContract;
use Illuminate\Support\Facades\DB;

class AuthVerifierService implements AuthVerifierContract
{
    /**
     * Description: Takes in user credentials, checks them against
     *              the CSUN/LDAP servers, and returns true or false
     *              based on whether the credentials are valid and
     *              whether the valid user is CSUN faculty or not.
     *
     * @param array $cred
     *
     * @return bool
     */
    public function isVerified(array $cred): bool
    {
        if (auth()->attempt($cred)) {
            $termCode = (string) env('CURRENT_TERM');
            $term = '';
            switch($termCode{3}) {
                case "3":
                    $term = "Spring";
                    break;
                case "5":
                    $term = "Summer";
                    break;
                case "7":
                    $term = "Fall";
                    break;
            }
            $term .= '-' . $termCode{0} . '0' . substr($termCode, 1, 2);
            $query = DB::table('class_instructors')
                ->where('user_id' , auth()->user()->user_id)
                ->where('term' , $term)
                ->first();
            if(!is_null($query)) {
                return true;
            }
            return false;

        }

        return false;
    }
}
