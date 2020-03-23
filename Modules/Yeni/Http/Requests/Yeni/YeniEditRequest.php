<?php

namespace Modules\Yeni\Http\Requests;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Yeni\Models\Yeni;

class YeniEditRequest extends FormRequest
{
    use DynamicRulesValidate;
    private $fields = null;
    private $operation = 'edit';

    public function __construct()
    {
        $this->fields = (new Yeni())->getSettings('fields');
    }
}
