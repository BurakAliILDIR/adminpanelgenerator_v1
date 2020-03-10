<?php


namespace App\Traits;


Trait Relations
{
    public function relation($field)
    {
        $result = null;
        switch ($field['type']) {
            case 'hasOne':
                $result = $this->hasOne($field['model'], $field['keys']['foreignKey'], $field['keys']['otherKey']);
                break;
            case 'hasMany':
                $result = $this->hasMany($field['model'], $field['keys']['otherKey'], $field['keys']['foreignKey']);
                break;
            case 'belongsTo':
                $result = $this->belongsTo($field['model'], $field['keys']['foreignKey'], $field['keys']['otherKey']);
                break;
            case 'belongsToMany':
                $result = $this->belongsToMany($field['model'], $field['keys']['table'], $field['keys']['foreignKey'], $field['keys']['otherKey']);
                break;
        }
        return $result;
    }
}
