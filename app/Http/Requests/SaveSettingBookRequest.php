<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Factory as ValidationFactory;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Response;

class SaveSettingBookRequest extends Request
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
          'title' => 'required',
          'subtitle' => 'required',
          'copyright' => 'required'
        );
        return $rules;
    }
}
