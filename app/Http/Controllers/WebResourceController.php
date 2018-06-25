<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\WebResourceRetrieverContract;

class WebResourceController extends Controller
{
    private $webResourceRetriever;

    /**
     * WebResourceController constructor.
     *
     * @param WebResourceRetrieverContract $webResourceRetriever
     * @param UserSettingsContract         $userSettingsRetriever
     */
    public function __construct(
        WebResourceRetrieverContract $webResourceRetriever
        ) {
        $this->webResourceRetriever = $webResourceRetriever;
    }

    /**
     * @param $term
     *
     * @return mixed
     */
    public function courses($term)
    {
        return $this->webResourceRetriever->getCourses($term);
    }

    /**
     * @param $term
     * @param $course
     *
     * @return mixed
     */
    public function roster($term, $course)
    {
        return $this->webResourceRetriever->getRoster($term, $course);
    }

    /**
     * @return mixed
     */
    public function media()
    {
        return $this->webResourceRetriever->getMedia();
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public function student($email)
    {
        return $this->webResourceRetriever->getStudent($email);
    }
}
