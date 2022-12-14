<?php
/**
 * Created by PhpStorm.
 * User: IT TELPRO
 * Date: 12/12/2022
 * Time: 00:38
 */

namespace Modules\Sipas\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;


class SuratkeluarRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge([
            'kategoriSk' => '',
            'klasifikasiSk' => '',
            'unitSk' => '',
//            'tahun' => '',
//            'nomor' => '',
//            'nomor_surat' => '',
            'tanggalSk' => '',
            'dariSk' => '',
            'kepadaSk' => '',
            'perihalSk' => '',
            'ketSk' => '',
            'lampiranSk' => ''
//            'created_by' => '',
//            'updated_by' => ''

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