<?php
/**
 * Created by PhpStorm.
 * User: IT TELPRO
 * Date: 12/12/2022
 * Time: 00:57
 */

namespace Modules\Sipas\Repositories\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Modules\Sipas\Entities\MSuratkeluar;
use Modules\Sipas\Entities\MUnit;
use Modules\Sipas\Repositories\Admin\Interfaces\SuratkeluarRepositoryInterface;
use Illuminate\Support\Str;

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
        )->orWhere(
            function ($query) {
                $query->where('id_unit', auth()->user()->group)
                    ->whereIn('status_id', array(3,4));
            }
        );

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
            return $suratkeluar->sortable()->orderBy('id', 'DESC')->paginate($perPage);
        }

        // if ($suratkeluar->count() != 0) {
        //     $file_surat_keluar = $suratkeluar->last()->getMedia('file_surat_keluar');
        // } else {
        //     $file_surat_keluar = null;
        // }

        // $data_surat_keluar = $suratkeluar->get();

        // return compact(['file_surat_keluar', 'data_surat_keluar']);
        return $suratkeluar->get();
    }

    public function create($params = [])
    {

        // 001/UM-000/GSD-2a000/I/2022
        $time = strtotime($params['tanggal_surat']);
        $tanggal_sekarang = date('Y-m-d');

        $bulan = date('m', $time);
        $tahun = date('Y', $time);

        // Cek Backdate atau Tidak
        if ($params['tanggal_surat'] < $tanggal_sekarang) {
            // TANGGAL BACKDATE
            $start_nomor = 1;
            $max_cadangan = 500;

            $last_suratkeluar = MSuratkeluar::where('tahun', $tahun)->where('kategori', $params['kategori'])->where('nomor', '<=', $max_cadangan)
                ->orderBy('id', 'DESC')
                ->first();
            if (empty($last_suratkeluar)) {
                $new_number = sprintf("%03d", $start_nomor);
            } else {
                if ($last_suratkeluar->nomor == $max_cadangan) {
                    // JIKA NOMOR CADANGAN KATEGGORI INI SUDAH HABIS
                    return alert('NOMOR CADANGAN SUDAH HABIS');
                } else {
                    $last_number = $last_suratkeluar->nomor;
                    $new_numbers = $last_number + 1;
                    $new_number = sprintf("%03d", $new_numbers);
                }
            }

        } else {
            // TANGGAL NORMAL ( TIDAK BACKDARTE )
            $start_nomor = 501;

            $last_suratkeluar = MSuratkeluar::where('tahun', $tahun)->where('kategori', $params['kategori'])->where('nomor', '>=', $start_nomor)
                ->orderBy('id', 'DESC')
                ->first();
            if (empty($last_suratkeluar)) {
                $new_number = sprintf("%03d", $start_nomor);
            } else {
                $last_number = $last_suratkeluar->nomor;
                $new_numbers = $last_number + 1;
                $new_number = sprintf("%03d", $new_numbers);
            }
        }

        if (!empty($params['id_unit'])) {
            $get_unit = MUnit::where('id', $params['id_unit'])
                ->orderBy('id', 'DESC')
                ->first();

            $unit = substr($get_unit->kode_unit_sap, 1, 9);
        }

        $no_surat = $new_number . '/' . $params['kategori'] . '-' . $params['klasifikasi'] . '/' . $unit . '/' . $bulan . '/' . $tahun;

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
        $suratkeluar->tanggal_surat = $params['tanggal_surat'];
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
        //Upload File
        if (isset($params['lampiranSk'])) {
            $suratkeluar->addMediaFromRequest('lampiranSk')->toMediaCollection('file_surat_keluar');
        }
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

    public function findAllworkspace($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

//        $suratmasuk = (new MSuratkeluar())->where('id_unit', auth()->user()->group)->where('status_id', 1)->orwhere('status_id', 2);
        $suratmasuk = (new MSuratkeluar())->where(
            function ($query) {
                $query->whereIn('status_id', array(1, 2))
                    ->where('id_unit', auth()->user()->group);
            }
        )->orWhere(
            function ($query) {
                $query->whereIn('status_id', array(3))
                    ->where('dari_id_unit', auth()->user()->group);
            }
        );

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
            return $suratmasuk->sortable()->orderBy('id', 'DESC')->paginate($perPage);
        }

        return $suratmasuk->get();
    }

    public function updateworkspace($id, $params = [])
    {
        $suratkeluar = MSuratkeluar::findOrFail($id);

        // $suratmasuk->nomor_surat = $params['nomor_surat'];
        // $suratmasuk->tanggal_surat = $params['tanggal_surat'];

        $suratkeluar->updated_by = auth()->user()->id;
        $suratkeluar->updated_by_name = auth()->user()->name;

        switch ($suratkeluar->status_id) {
            case 2:
                $suratkeluar->status_id = 3;
                $suratkeluar->status = 'Done';
                $this->send_notifikasi($suratkeluar);
                // $this->send_wa();
                break;
            case 3:
                $suratkeluar->status_id = 4;
                $suratkeluar->status = 'Closed';

                //Upload File
                if (isset($params['lampiranSk'])) {
                    $suratkeluar->addMediaFromRequest('lampiranSk')->toMediaCollection('file_surat_keluar');
                }

                break;
            default:
                $suratkeluar->status_id = 2;
                $suratkeluar->status = 'Received';
                break;
        }

        return $suratkeluar->save();
    }

    public function send_notifikasi($params)
    {
        $user_unit = User::find($params->created_by);
        $url = 'https://wa01.ocatelkom.co.id/api/v2/push/message';
        $token = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwiYXBwbGljYXRpb24iOiI2MzYzNzU5ZTBjOTQ5NDAwMjE3NjM0YTkiLCJpYXQiOjE1MTYyMzkwMjJ9.dCsEsnctWvZfsu9OGYGKCQW5u0-oRAnAI7806-4Dl0ea57kgggTY7rC5pJYwtfabOybcM5loP95Bam_CTkQ4l2Nm_yxiRBDTT-xfq8uC1JwKclZu0ZS2ekjO-MXuk08tntnXCpi-gTVvAuYno1QaFgpsMFed6HuQB60IlHyxGH9CTnA7Nsfyc0vCI2KH9px2MhwIOWTsN8p_GRE-yk80eOVnAwMGQ3JoMVpV0bbu9Bs5xAyQVprGINAwfja_VhkemEf4Ad9ZOR1Y-LDtI_7-qRVgPZAs1bHaqbPhrp3BSHal4CUauXfHFLBsAar7-7KWZNYgcK7KCRESwTIucPcfmQ';
        $body = '{
                "phone_number": "' . $user_unit->nomor_tlp . '",
                "message": {
                    "type": "template",
                    "template": {
                        "template_code_id": "a1b52102_7d78_4d09_9e95_0cec44bea8c7:template_notifikasi_surat",
                        "payload": [
                            {
                                "position": "header",
                                "parameters": [
                                    {
                                        "type": "image",
                                        "image": {
                                                "url": "https://storage.ocatelkom.co.id/image/bUU7Yg2faks6qPm22N2M16112022jpeg.jpeg"
                                        }
                                    }
                                ]
                            },
                            {
                                "position": "body",
                                "parameters": [
                                    {
                                        "type": "text",
                                        "text": "' . $user_unit->name . '"
                                    },
                                    {
                                        "type": "text",
                                        "text": "' . $params->nomor_surat . '"
                                    }
                                ]
                            }
                        ]
                    }
                }
            }';

        $body = Str::replace("\n", '', $body);
        $response = Http::withOptions(['verify' => false])->withToken($token)->withBody($body, 'application/json')->post($url);
    }

}
