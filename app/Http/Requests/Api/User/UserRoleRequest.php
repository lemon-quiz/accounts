<?php

namespace App\Http\Requests\Api\User;

use App\Lib\Auth\RequestAuthTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRoleRequest extends FormRequest
{
    use RequestAuthTrait;
    use RequestAuthTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @param Request $request
     * @return bool
     */
    public function authorize(Request $request)
    {
        return $this->hasAccess($request->user(), 'accounts-user-role', $request->method());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role_id' => 'required',
            'read' => 'boolean',
            'write' => 'boolean',
            'update' => 'boolean',
            'delete' => 'boolean',
        ];
    }
}
