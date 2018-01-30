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
     */
    public function __construct(WebResourceRetrieverContract $webResourceRetriever)
    {
        $this->webResourceRetriever = $webResourceRetriever;
    }

    /**
     * @return mixed
     */
    public function courses()
    {
        return $this->webResourceRetriever->getCourses();
    }

    /**
     * @return mixed
     */
    public function roster()
    {
        return $this->webResourceRetriever->getRoster();
    }

    /**
     * @return mixed
     */
    public function media()
    {
        return $this->webResourceRetriever->getMedia();
    }
}
