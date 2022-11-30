<?php

namespace App\Api\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperationIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "user_id" => ["filled", "int"],
            "date" => ["filled", "date_format:Y-m-d"],
            "sortBy" => ["filled", "in:id,created_at"],
            "sortDir" => ["filled", "in:asc,desc"]
        ];
    }
}
