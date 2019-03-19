<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\WebResourceRetrieverContract;

class WebResourceController extends Controller
{
    private $webResourceUtility;

    /**
     * WebResourceController constructor.
     *
     * @param WebResourceRetrieverContract $webResourceUtility
     * @param UserSettingsContract         $userSettingsRetriever
     */
    public function __construct(
        WebResourceRetrieverContract $webResourceUtility
        ) {
        $this->webResourceUtility = $webResourceUtility;
    }

    /**
     * @param $term
     *
     * @return mixed
     */
    public function courses($term)
    {
        $courses = $this->webResourceUtility->getCourses($term);
        return ['courses' => $courses];
    }

    /**
     * @param $term
     * @param $course
     *
     * @return mixed
     */
    public function roster($term, $course)
    {
        return $this->webResourceUtility->getRoster($term, $course);
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public function student($email)
    {
        return $this->webResourceUtility->getStudent($email);
    }
}
