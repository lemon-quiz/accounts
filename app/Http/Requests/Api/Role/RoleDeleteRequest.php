<?php

namespace App\Http\Requests\Api\Role;

use App\Lib\Auth\RequestAuthTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RoleDeleteRequest extends FormRequest
{
    use RequestAuthTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @param Request $request
     * @return bool
     */
    public function authorize(Request $request)
    {
        return $this->hasAccess($request->user(), 'accounts-role', $request->method());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
