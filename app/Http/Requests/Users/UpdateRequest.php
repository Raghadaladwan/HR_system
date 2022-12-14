<?php

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    protected $data;

    protected $hrData = [
        'name' => ['required', 'max:255'],
        'email' => ['email', 'max:255', 'unique:users'],
        'status' => ['required', 'boolean'],
        'job_title' => ['required', 'max:255']
    ];

    protected $employeeData = [
        'contact' => ['required','max:15'],
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    
        $this->data = (Auth::user()->user_type == User::HR) ? $this->hrData : $this->employeeData;
        
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return $this->data;
    }
}
