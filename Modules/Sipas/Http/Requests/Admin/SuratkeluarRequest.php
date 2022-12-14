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
            'kategori' => '',
            'klasifikasi' => '',
            'tanggal_surat' => '',
            'id_unit' => '',
            'dari' => '',
            'dari_id_unit' => '',
            'dari_kode_unit' => '',
            'kepada' => '',
            'perihal' => '',
            'keterangan' => '',
//            'lampiranSk' => ''

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