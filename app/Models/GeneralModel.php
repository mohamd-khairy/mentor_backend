<?php

namespace App\Models;

trait GeneralModel
{
    public function toArray()
    {
        $attributes = parent::toArray();
        try {
            foreach ($this->getTranslatableAttributes() as $field) {
                if (in_array($field, $this->visible)) {
                    $attributes[$field] = $this->getTranslation($field, app()->getLocale());
                }
            }
        } catch (\Throwable $th) {
        }

        try {
            foreach ($this->relations_array as $key => $field) {
                if ($field['relation_name']) {
                    $attributes[$field['relation_name']] = $this->{$field['relation_name']}->{$field['coulmn']} ?? '';
                    unset($attributes[$field['item']]);
                }
            }
        } catch (\Throwable $th) {
        }
        return $attributes;
    }

    public function getfillableTypes()
    {
        return $this->fillableType;
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}