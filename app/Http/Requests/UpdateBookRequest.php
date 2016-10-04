<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Factory as ValidationFactory;
use Carbon\Carbon;
use Illuminate\Http\Response;

class UpdateBookRequest extends Request
{
    /**
     * Contructor of EventEditRequest
     *
     * @param ValidationFactory $validationFactory Validator Factory
     *
     * @return Void
     */
    public function __construct()
    {

    }

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
        $rules = array(
          'title' => 'required|min:6',
          'subtitle' => 'required|min:5',
          'teaser' => 'required'
        );
        return $rules;
    }
}
