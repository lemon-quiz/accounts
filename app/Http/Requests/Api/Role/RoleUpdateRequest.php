<?php

namespace App\Http\Requests\Api\Role;

use App\Lib\Auth\RequestAuthTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends FormRequest
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
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'name' => ['required', Rule::unique('roles')->ignore($request->route('role'))],
            'private' => 'required|boolean',
            'init_employee' => 'required|boolean',
        ];
    }
}
