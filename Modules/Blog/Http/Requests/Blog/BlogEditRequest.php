<?php

namespace Modules\Blog\Http\Requests\Blog;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Blog\Models\Blog;

class BlogEditRequest extends FormRequest
{
    use DynamicRulesValidate;
    private $fields = null;
    private $operation = 'edit';

    public function __construct()
    {
        $this->fields = (new Blog())->getSettings('fields');
    }
}
