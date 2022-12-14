<?php
/**
 * Created by PhpStorm.
 * User: IT TELPRO
 * Date: 12/12/2022
 * Time: 00:38
 */

namespace Modules\Sipas\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;


class SuratmasukRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge([
            'nomor_surat' => '',
            'tanggal_surat' => '',
            'tanggal_terima' => '',
            'perihal' => '',
            'dari' => '',
            'kepada' => '',
        ]);
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
}