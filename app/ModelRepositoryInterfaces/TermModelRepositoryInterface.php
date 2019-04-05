<?php

declare(strict_types=1);

namespace App\ModelRepositoryInterfaces;

interface TermModelRepositoryInterface
{
    public function find();

    public function all(): array;

    public function getPreviousTerm();

    public function getNowAndNextTerm();
}
