<?php

namespace Gergonzalez\Fractal;

use League\Fractal\TransformerAbstract;

abstract class BaseTransformer extends TransformerAbstract
{

    /**
     * @param Array $fields
     */
    public function __construct($fields = null)
    {
        $this->fields = $fields;
    }

    /**
     * Filters transformer data.
     *
     * @param array $data
     *
     * @return array
     */
    protected function transformWithFieldFilter($data)
    {
        if (is_null($this->fields)) {
            return $data;
        }

        return array_intersect_key($data, array_flip((array) $this->fields));
    }
}
