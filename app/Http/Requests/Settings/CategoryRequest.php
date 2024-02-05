<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\BaseRequest;
use App\Models\Settings\Category;
use Closure;

class CategoryRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'index' => 'required|integer',
            'parent_id' => 'nullable|integer',
            'is_active' => 'required|boolean',
        ];

        if ($this->method() === 'PUT') {
            $rules['parent_id'] = [
                'nullable',
                'integer',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value) {
                        $category = Category::find($value);

                        if ($category->parent_id === $this->id) {
                            $fail('Child category can not be parent category.');
                        }
                    }
                },
            ];
        }

        return $rules;
    }
}
