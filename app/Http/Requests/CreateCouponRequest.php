<?php
namespace App\Http\Requests;

use Illuminate\Http\Response;

class CreateCouponRequest extends Request
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
          'coupon_code' => 'required',
          'coupon_note' => 'required',
          'number' => 'required|numeric',
          'unit' => 'required',
          'limitcount' => 'required|numeric',
          'start_date' => 'required|date_format:Y-m-d H:i:s',
          'end_date' => 'date_format:Y-m-d H:i:s|greater_than_field:start_date'
        );
        return $rules;
    }

    /**
     * Set custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
          'end_date.date_format' => 'The date is must follow format: Y-m-d H:i:s',
          'end_date.greater_than_field' => 'The end date must be greater than start date'
        ];
    }
}
