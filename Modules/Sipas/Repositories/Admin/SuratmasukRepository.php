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
        // Insert Customer
        $suratmasuk = new MSuratmasuk();
        $suratmasuk->name = $params['name'];
        return $suratmasuk->save();
    }

    public function findById($id)
    {
        return MSuratmasuk::findOrFail($id);
    }

    public function update($id, $params = [])
    {
        $suratmasuk = MSuratmasuk::findOrFail($id);
        $suratmasuk->name = $params['name'];
        return $suratmasuk->save();
    }

    public function delete($id)
    {
        $suratmasuk = MSuratmasuk::findOrFail($id);
        return $suratmasuk->forceDelete();
    }
}