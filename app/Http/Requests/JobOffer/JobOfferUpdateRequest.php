<?php

namespace App\Http\Requests\JobOffer;

use Illuminate\Foundation\Http\FormRequest;

class JobOfferUpdateRequest extends FormRequest
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
        //Obtener el rol
        $job_offer = $this->route('job_offer');

        //Si el rol existe se puede quedar con los mismos datos pero no duplicar los datos de otros
        if ($job_offer) {
            return [
                'name' => 'required|unique:job_offers,name,' . $job_offer->id,
                'state' => 'required'
            ];
        }
    }
}
