<?php

namespace Chargefield\Supermodels\Exceptions;

use Chargefield\Supermodels\Traits\Savable;
use Exception;
use Illuminate\Database\Eloquent\Model;

class NotSavableException extends Exception
{
    public function __construct(Model $model)
    {
        $trait = Savable::class;
        $class = get_class($model);
        $message = "{$class} needs to use the {$trait} trait.";
        parent::__construct($message);
    }
}
