<?php

namespace App\Traits\ValidationTraits;

trait DynamicRulesValidate
{
    public function rules()
    {
        $validates = [];
        foreach ($this->fields as $key => $field) {
            if ($field[$this->operation]) {
                $row = '';
                $rules = $field['rules'];
                foreach ($rules as $rule) {
                    $row .= last($rules) === $rule ? $rule : ($rule . '|');
                }
                $validates[$key] = $row;
            }
        }

        return $validates;
    }

    public function attributes()
    {
        $attributes = [];
        foreach ($this->fields as $key => $field) {
            if ($field[$this->operation])
                $attributes[$key] = $field['title'];
        }
        return $attributes;
    }

    /* CUSTOM VALIDATE MESSAGES
    public function messages()
   {

       $validates = [];
       foreach ($this->fields as $key => $field) {
           if ($field['create']) {
               $row = '';
               $rules = $field['rules'];
               foreach ($rules as $rule) {
                   $row .= last($rules) === $rule ? $rule : ($rule . '|');
                   $validates[$key.".". $rule] = __("dogrulama.".$rule, ["alan" => $field["title"]]);
               }

           }
       }
//        dd($validates);
       return $validates;
   }*/
}
