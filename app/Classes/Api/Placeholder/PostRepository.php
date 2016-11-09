<?php

namespace App\Classes\Api\Placeholder;

use App\Classes\Api\Repository;
use App\Classes\Api\Interfaces\PostRepositoryInterface;

class PostRepository extends Repository implements PostRepositoryInterface
{
    /**
     * Model associated with the class.
     *
     * @var string
     */
    protected $model = 'posts';
}