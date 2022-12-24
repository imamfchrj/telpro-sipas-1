<?php
/**
 * Created by PhpStorm.
 * User: IT TELPRO
 * Date: 12/12/2022
 * Time: 00:57
 */

namespace Modules\Sipas\Repositories\Admin;

use DB;
use Modules\Sipas\Entities\MSuratkeluar;
use Modules\Sipas\Entities\MUnit;
use Modules\Sipas\Repositories\Admin\Interfaces\SuratkeluarRepositoryInterface;

class SuratkeluarRepository implements SuratkeluarRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $suratkeluar = (new MSuratkeluar())->where(
            function ($query) {
                if (auth()->user()->roles[0]->id == 8 || auth()->user()->roles[0]->id == 9 || auth()->user()->roles[0]->id == 11) {
                    $query->where('created_by', auth()->user()->id);
                }
            }
        );
//            ->orWhere(
//            function ($query) {
//                $query->where('kepada_id_unit', auth()->user()->group)
//                    ->where('status_id', 2);
//            }
//        );

        if ($orderByFields) {
            foreach ($orderByFields as $field => $sort) {
                $suratkeluar = $suratkeluar->orderBy($field, $sort);
            }
        }

        if (!empty($options['filter']['q'])) {
            $suratkeluar = $suratkeluar->where(function ($query) use ($options) {
                $query->where('perihal', 'LIKE', "%{$options['filter']['q']}%");
            });
        }

        if ($perPage) {
            return $suratkeluar->paginate($perPage);
        }

        return $suratkeluar->get();
    }

    public function create($params = [])
    {

        // 001/UM-000/GSD-2a000/I/2022
        $time = strtotime($params ['tanggal_surat']);
        $bulan = date('m', $time);
        $tahun = date('Y', $time);

        $last_suratkeluar = MSuratkeluar::where('tahun', $tahun)->where('kategori', $params['kategori'])
            ->orderBy('id', 'DESC')
            ->first();
        if (empty($last_suratkeluar)) {
            $new_number = sprintf("%03d", 001);
        } else {
            $last_number = $last_suratkeluar->nomor;
            $new_numbers = $last_number + 1;
            $new_number = sprintf("%03d", $new_numbers);
        }
        if (!empty($params['id_unit'])) {
            $get_unit = MUnit::where('id', $params['id_unit'])
                ->orderBy('id', 'DESC')
                ->first();

            $unit = substr($get_unit->kode_unit_sap, 1, 9);
        }

        $no_surat = $new_number . '/' . $params['kategori'] . '-' . $params['klasifikasi'] . '/' . $unit . '/' . $bulan . '/' . $tahun;
//        dd($no_surat);
//        exit;




        // Insert Customer
        $suratkeluar = new MSuratkeluar();
        $suratkeluar->kategori = $params['kategori'];
        $suratkeluar->klasifikasi = $params['klasifikasi'];
        $suratkeluar->id_unit = $params['id_unit'];
        $suratkeluar->kode_unit = $get_unit->kode_unit_sap;
        $suratkeluar->nama_unit = $get_unit->unit;
        $suratkeluar->tahun = $tahun;
        $suratkeluar->nomor = $new_number;
        $suratkeluar->nomor_surat = $no_surat;
        $suratkeluar->tanggal_surat = $params ['tanggal_surat'];
        $suratkeluar->dari = $params['dari'];
        $suratkeluar->dari_id_unit = $params['dari_id_unit'];
        $suratkeluar->dari_kode_unit = $params['dari_kode_unit'];
        $suratkeluar->kepada = $params['kepada'];
        $suratkeluar->perihal = $params['perihal'];
        $suratkeluar->keterangan = $params['keterangan'];
        $suratkeluar->status_id = 1;
        $suratkeluar->status = 'Submit';
        $suratkeluar->created_by = auth()->user()->id;
        $suratkeluar->created_by_name = auth()->user()->name;
        return $suratkeluar->save();
    }

    public function findById($id)
    {
        return MSuratkeluar::findOrFail($id);
    }

    public function update($id, $params = [])
    {
        $suratkeluar = MSuratkeluar::findOrFail($id);
        $suratkeluar->name = $params['name'];
        return $suratkeluar->save();
    }

    public function delete($id)
    {
        $suratkeluar = MSuratkeluar::findOrFail($id);
        return $suratkeluar->forceDelete();
    }
}