<?php
/**
 * Created by PhpStorm.
 * User: IT TELPRO
 * Date: 12/12/2022
 * Time: 00:57
 */

namespace Modules\Sipas\Repositories\Admin;

use DB;
use App\Models\User;
use Modules\Sipas\Entities\MSuratmasuk;
use Modules\Sipas\Entities\MUnit;
use Modules\Sipas\Repositories\Admin\Interfaces\SuratmasukRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class SuratmasukRepository implements SuratmasukRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $suratmasuk = (new MSuratmasuk())->where(
            function ($query) {
                if (auth()->user()->roles[0]->id == 8 || auth()->user()->roles[0]->id == 9 || auth()->user()->roles[0]->id == 11) {
                    $query->where('created_by', auth()->user()->id);
                }
            }
        )->orWhere(
            function ($query) {
                $query->where('disposisi', auth()->user()->group)
                    ->where('status_id', 2);
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
//                    ->orWhere('nomor_surat', 'LIKE', "%{$options['filter']['q']}%")
//                    ->orWhere('perihal', 'LIKE', "%{$options['filter']['q']}%")
//                    ->orWhere('dari', 'LIKE', "%{$options['filter']['q']}%")
//                    ->orWhere('disposisi_name', 'LIKE', "%{$options['filter']['q']}%")
//                    ->orWhere('status', 'LIKE', "%{$options['filter']['q']}%");
            });
        }

        if ($perPage) {
            return $suratmasuk->sortable()->orderBy('id', 'DESC')->paginate($perPage);
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
        $suratmasuk->created_by = auth()->user()->id;
        $suratmasuk->created_by_name = auth()->user()->name;
        $suratmasuk->status_id = 1;
        $suratmasuk->status = 'Pending Received';

        $unit_id_tujuan = $unit_id;
        $user_units = User::where('group', $unit_id_tujuan)->get();
        foreach ($user_units as $user) {
            $no_telp_pic = $user->nomor_tlp;
            $nama_pic = $user->name;
            $this->send_notifikasi($suratmasuk, $no_telp_pic, $nama_pic);
        }
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

    //WORKSPACE

    public function findAllworkspace($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $suratmasuk = (new MSuratmasuk())->where('disposisi', auth()->user()->group)->where('status_id', 1);

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
        $suratmasuk = MSuratmasuk::findOrFail($id);
        $suratmasuk->nomor_surat = $params['nomor_surat'];
        $suratmasuk->tanggal_surat = $params['tanggal_surat'];
        $suratmasuk->perihal = $params['perihal'];
        $suratmasuk->updated_by = auth()->user()->id;
        $suratmasuk->updated_by_name = auth()->user()->name;
        $suratmasuk->status_id = 2;
        $suratmasuk->status = 'Received';
        return $suratmasuk->save();
    }

    public function send_notifikasi($params,$no_tlp_pic, $nama_pic)
    {
        $url = 'https://wa01.ocatelkom.co.id/api/v2/push/message';
        $token = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwiYXBwbGljYXRpb24iOiI2MzYzNzU5ZTBjOTQ5NDAwMjE3NjM0YTkiLCJpYXQiOjE1MTYyMzkwMjJ9.dCsEsnctWvZfsu9OGYGKCQW5u0-oRAnAI7806-4Dl0ea57kgggTY7rC5pJYwtfabOybcM5loP95Bam_CTkQ4l2Nm_yxiRBDTT-xfq8uC1JwKclZu0ZS2ekjO-MXuk08tntnXCpi-gTVvAuYno1QaFgpsMFed6HuQB60IlHyxGH9CTnA7Nsfyc0vCI2KH9px2MhwIOWTsN8p_GRE-yk80eOVnAwMGQ3JoMVpV0bbu9Bs5xAyQVprGINAwfja_VhkemEf4Ad9ZOR1Y-LDtI_7-qRVgPZAs1bHaqbPhrp3BSHal4CUauXfHFLBsAar7-7KWZNYgcK7KCRESwTIucPcfmQ';
        $body = '{
                "phone_number": "' . $no_tlp_pic . '",
                "message": {
                    "type": "template",
                    "template": {
                        "template_code_id": "a1b52102_7d78_4d09_9e95_0cec44bea8c7:template_notifikasi_srt_masuk",
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
                                        "text": "' . $nama_pic . '"
                                    },
                                    {
                                        "type": "text",
                                        "text": "' . $params->dari . '"
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