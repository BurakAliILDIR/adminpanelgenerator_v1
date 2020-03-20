<?php


namespace App\Traits\ModelTraits;


Trait Relations
{
    public function relation($relationship)
    {
        $result = null;
        switch ($relationship['type']) {
            case 'hasOne':
                $result = $this->hasOne($relationship['model'], $relationship['keys']['foreignKey'], $relationship['keys']['otherKey']);
                break;
            case 'hasMany':
                $result = $this->hasMany($relationship['model'], $relationship['keys']['otherKey'], $relationship['keys']['foreignKey']);
                break;
            case 'belongsTo':
                $result = $this->belongsTo($relationship['model'], $relationship['keys']['foreignKey'], $relationship['keys']['otherKey']);
                break;
            case 'belongsToMany':
                $result = $this->belongsToMany($relationship['model'], $relationship['keys']['table'], $relationship['keys']['foreignKey'], $relationship['keys']['otherKey']);
                break;
        }
        return $result;
    }
}
