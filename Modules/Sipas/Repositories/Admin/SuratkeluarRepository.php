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
use Modules\Sipas\Repositories\Admin\Interfaces\SuratkeluarRepositoryInterface;

class SuratkeluarRepository implements SuratkeluarRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $suratkeluar = new MSuratkeluar();

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
        // Format Number JIB
//        $tahun = date('Y');
//        $array_bulan = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
//        $bulan = $array_bulan[date('n')];
//
//        $last_pegnajuan = Pengajuan::where('tahun', $tahun)->where('kategori_id', 1)
//            ->orderBy('id', 'DESC')
//            ->first();
//        if (empty($last_pegnajuan)) {
//            $new_number = sprintf("%05d", 00001);
//        } else {
//            $last_number = $last_pegnajuan->number;
//            $new_numbers = $last_number + 1;
//            $new_number = sprintf("%05d", $new_numbers);
//        }
//        $no_jib = $new_number . '/JIB/B/' . $bulan . '/' . $tahun;
        $time = strtotime($params ['tanggalSk']);
        $tahun = date('Y', $time);

        $last_suratkeluar = MSuratkeluar::where('tahun', $tahun)
            ->orderBy('id', 'DESC')
            ->first();
        if (empty($last_suratkeluar)) {
            $new_number = sprintf("%05d", 00001);
        } else {
            $last_number = $last_suratkeluar->nomor;
            $new_numbers = $last_number + 1;
            $new_number = sprintf("%05d", $new_numbers);
        }

        $unitSK = substr($params['unitSk'], 1, 9);

        $no_surat = $new_number. '/' .$params['kategoriSk']. '-' .$params['klasifikasiSk']. '/' .$unitSK. '/' .$tahun;
//        dd($no_surat);
//        exit;

        // Insert Customer
        $suratkeluar = new MSuratkeluar();
        $suratkeluar->kategori = $params['kategoriSk'];
        $suratkeluar->klasifikasi = $params['klasifikasiSk'];
        $suratkeluar->unit_kerja = $params['unitSk'];
        $suratkeluar->tahun = $tahun;
        $suratkeluar->nomor = $new_number;
        $suratkeluar->nomor_surat = $no_surat;
        $suratkeluar->tanggal_surat = $params ['tanggalSk'];
        $suratkeluar->dari = $params['dariSk'];
        $suratkeluar->kepada = $params['kepadaSk'];
        $suratkeluar->perihal = $params['perihalSk'];
        $suratkeluar->keterangan = $params['ketSk'];
        $suratkeluar->status_id = 1;
        $suratkeluar->status = 'Menunggu Approval CA';
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