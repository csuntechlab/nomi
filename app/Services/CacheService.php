<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\CacheContract;
use App\Contracts\RosterRetrievalContract;
use App\Contracts\WebResourceRetrieverContract;
use Illuminate\Contracts\Cache\Repository;

class CacheService implements CacheContract
{
    protected $webResourceRetrieverUtility;
    protected $rosterRetrievalUtility;
    protected $cache;

    public function __construct(
        WebResourceRetrieverContract $webResourceRetrieverUtility,
        RosterRetrievalContract $rosterRetrievalUtility,
        Repository $repository
        ) {
        $this->webResourceRetrieverUtility = $webResourceRetrieverUtility;
        $this->rosterRetrievalUtility = $rosterRetrievalUtility;
        $this->cache = $repository;
    }

    /**
     * Description:.
     *
     * @param mixed $id
     * @param mixed $term
     * @param mixed $minutes
     */
    public function cacheCourses($id, $term, $minutes)
    {
        if ($this->cache->has('courses:' . $id . 'term:' . $term)) {
            $courses = $this->cache->get('courses:' . $id . 'term:' . $term);
        } else {
            $courses = $this->webResourceRetrieverUtility->getCourses($term);
            $this->cache->put('courses:' . $id . 'term:' . $term, $courses, $minutes);
        }

        return  $courses;
    }

    public function cacheStudents($students, $courses, $len, $id, $term, $minutes)
    {
        for ($i = 0; $i < $len; ++$i) {
            if ($this->cache->has('students:' . $i . ':' . $id . 'term:' . $term)) {
                $students[$i] = $this->cache->get('students:' . $i . ':' . $id . 'term:' . $term);
            } else {
                $students[$i] = $this->rosterRetrievalUtility->getStudentsFromRoster($term, $i);
                $this->cache->put('students:' . $i . ':' . $id . 'term:' . $term, $students[$i], $minutes);
            }

            $courses[$i]->roster = $students[$i];
        }

        return $students;
    }
}
