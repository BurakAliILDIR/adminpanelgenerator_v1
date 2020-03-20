<?php

namespace Modules\Deneme\Http\Requests\Deneme;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Deneme\Entities\Deneme;

class DenemeCreateRequest extends FormRequest
{
    use DynamicRulesValidate;
    private $fields = null;
    private $operation = 'create';

    public function __construct()
    {
        $this->fields = (new Deneme())->getSettings('fields');
    }
}
