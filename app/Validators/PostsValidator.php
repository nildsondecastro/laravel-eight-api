<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class CommentsValidator.
 *
 * @package namespace App\Validators;
 */
class PostsValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title' => 'required',
            'body'  => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title' => 'required',
            'body'  => 'required'
        ],
    ];
}
