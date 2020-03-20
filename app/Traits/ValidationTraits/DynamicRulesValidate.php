<?php

namespace App\Traits\ValidationTraits;

trait DynamicRulesValidate
{
    public function rules()
    {
        $validates = [];
        foreach ($this->fields as $field) {
            if ($field[$this->operation]) {
                $row = '';
                $rules = $field['rules'];
                foreach ($rules as $rule) {
                    $row .= last($rules) === $rule ? $rule : ($rule . '|');
                }
                $validates[$field['name']] = $row;
            }
        }

        return $validates;
    }

    public function attributes()
    {
        $attributes = [];
        foreach ($this->fields as $field) {
            if ($field[$this->operation])
                $attributes[$field["name"]] = $field["title"];
        }
        return $attributes;
    }

    /* CUSTOM VALIDATE MESSAGES
    public function messages()
   {

       $validates = [];
       foreach ($this->fields as $field) {
           if ($field['create']) {
               $row = '';
               $rules = $field['rules'];
               foreach ($rules as $rule) {
                   $row .= last($rules) === $rule ? $rule : ($rule . '|');
                   $validates[$field['name'].".". $rule] = __("dogrulama.".$rule, ["alan" => $field["title"]]);
               }

           }
       }
//        dd($validates);
       return $validates;
   }*/
}
