<?php

namespace Chargefield\Supermodel\Fields;

class BooleanField extends Field
{
    /**
     * @param array $fields
     * @return bool|null
     */
    public function handle(array $fields = [])
    {
        if (empty($this->value) && $this->nullable) {
            return null;
        }

        return filter_var(
            $this->value,
            FILTER_VALIDATE_BOOLEAN,
            $this->nullable ? FILTER_NULL_ON_FAILURE : null
        );
    }
}
