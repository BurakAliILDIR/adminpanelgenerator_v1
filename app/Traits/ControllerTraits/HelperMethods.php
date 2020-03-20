<?php

namespace App\Traits\ControllerTraits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

Trait HelperMethods
{
    private function many_to_many_sync(Request $request, $fields, $operation_type) : void
    {
        foreach ($fields as $field) {
            if ( !$field[$operation_type]) continue;
            if ($field['type'] === 'multi_checkbox')
                $this->model->relation($field['relationship'])->sync($request[$field['name']]);
        }
    }

    private function insertToSingleMedia(Request $request, $name) : void
    {
        if ($request->hasFile($name))
            $this->model
                ->addMedia(\request($name))
                ->sanitizingFileName(function ($fileName) {
                    return str_replace(['#', '/', '\\', ' ', '\'', '!', '&', '|', '(', ')', '<', '>',
                        '%', '$', '£', 'ß', 'æ', '{', '}', '[', ']', '?', '=', '*', '+', '½', ',',
                        '~', 'ğ', 'İ', 'ı', '-', 'ç', 'ş', 'ü', 'ö', '_'],
                        '', Str::kebab($fileName));
                })
                ->toMediaCollection($name);
    }
}
