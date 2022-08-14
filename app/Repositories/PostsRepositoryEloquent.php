<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\postsRepository;
use App\Entities\Posts;
use App\Validators\PostsValidator;

/**
 * Class PostsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PostsRepositoryEloquent extends BaseRepository implements PostsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Posts::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
