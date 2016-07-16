<?php
namespace JobPortal\Http\Requests;

use JobPortal\Http\Requests\Request;

class JobForm extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'email'   => 'required|email',
            'title'   => ['required', 'Regex:/^[A-Za-z-_ "\'\/]+$/'],
            'details' => ['required', 'Regex:/^[A-Za-z\d-_ "\'\/]+$/'],
        ];
    }

    public function messages()
    {
        return [
            'title.regex' => 'The job title field can only contain letters, hyphens, underscores, spaces, single quotes or double quotes',
            'details.regex' => 'The job details field can only contain letters, 
                                numbers, hyphens, underscores, spaces, single quotes or double quotes',
        ];
    }
}
