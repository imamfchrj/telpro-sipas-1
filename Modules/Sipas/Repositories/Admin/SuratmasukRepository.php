<?php
/**
 * Created by PhpStorm.
 * User: IT TELPRO
 * Date: 12/12/2022
 * Time: 00:57
 */

namespace Modules\Sipas\Repositories\Admin;

use DB;
use Modules\Sipas\Entities\MSuratmasuk;
use Modules\Sipas\Entities\MUnit;
use Modules\Sipas\Repositories\Admin\Interfaces\SuratmasukRepositoryInterface;

class SuratmasukRepository implements SuratmasukRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $suratmasuk = new MSuratmasuk();

        if ($orderByFields) {
            foreach ($orderByFields as $field => $sort) {
                $suratmasuk = $suratmasuk->orderBy($field, $sort);
            }
        }

        if (!empty($options['filter']['q'])) {
            $suratmasuk = $suratmasuk->where(function ($query) use ($options) {
                $query->where('perihal', 'LIKE', "%{$options['filter']['q']}%");
            });
        }

        if ($perPage) {
            return $suratmasuk->paginate($perPage);
        }

        return $suratmasuk->get();
    }

    public function create($params = [])
    {
        $cek_unit = MUnit::where('kode_loker_sap', $params['kepada'])
            ->orderBy('id', 'DESC')
            ->first();
        $unit_id = $cek_unit->id;
        $unit_kode = $cek_unit->kode_unit_sap;
        $unit_name = $cek_unit->unit;

        $time = strtotime($params ['tanggal_terima']);
        $tahun = date('Y', $time);

        // Insert Customer
        $suratmasuk = new MSuratmasuk();
        $suratmasuk->nomor_surat = $params['nomor_surat'];
        $suratmasuk->tanggal_surat = $params['tanggal_surat'];
        $suratmasuk->tanggal_terima = $params['tanggal_terima'];
        $suratmasuk->tahun = $tahun;
        $suratmasuk->perihal = $params['perihal'];
        $suratmasuk->dari = $params['dari'];
        $suratmasuk->disposisi = $unit_id;
        $suratmasuk->disposisi_kode_unit = $unit_kode;
        $suratmasuk->disposisi_name = $unit_name;
        return $suratmasuk->save();
    }

    public function findById($id)
    {
        return MSuratmasuk::findOrFail($id);
    }

    public function update($id, $params = [])
    {
        $cek_unit = MUnit::where('kode_loker_sap', $params['kepada'])
            ->orderBy('id', 'DESC')
            ->first();
        $unit_id = $cek_unit->id;
        $unit_kode = $cek_unit->kode_unit_sap;
        $unit_name = $cek_unit->unit;

        $time = strtotime($params ['tanggal_terima']);
        $tahun = date('Y', $time);

        $suratmasuk = MSuratmasuk::findOrFail($id);
        $suratmasuk->nomor_surat = $params['nomor_surat'];
        $suratmasuk->tanggal_surat = $params['tanggal_surat'];
        $suratmasuk->tanggal_terima = $params['tanggal_terima'];
        $suratmasuk->tahun = $tahun;
        $suratmasuk->perihal = $params['perihal'];
        $suratmasuk->dari = $params['dari'];
        $suratmasuk->disposisi = $unit_id;
        $suratmasuk->disposisi_kode_unit = $unit_kode;
        $suratmasuk->disposisi_name = $unit_name;
        return $suratmasuk->save();
    }

    public function delete($id)
    {
        $suratmasuk = MSuratmasuk::findOrFail($id);
        return $suratmasuk->forceDelete();
    }
}