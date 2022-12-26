<?php
/**
 * Created by PhpStorm.
 * User: IT TELPRO
 * Date: 12/12/2022
 * Time: 11:19
 */

namespace Modules\Sipas\Repositories\Admin;

use DB;
use Modules\Sipas\Entities\MUnit;
use Modules\Sipas\Repositories\Admin\Interfaces\UnitRepositoryInterface;

class UnitRepository implements UnitRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $unit = (new MUnit())->where('area','PUSAT');

        if ($orderByFields) {
            foreach ($orderByFields as $field => $sort) {
                $unit = $unit->orderBy($field, $sort);
            }
        }

        if (!empty($options['filter']['q'])) {
            $unit = $unit->where(function ($query) use ($options) {
                $query->where('unit', 'LIKE', "%{$options['filter']['q']}%");
            });
        }

        if ($perPage) {
            return $unit->paginate($perPage);
        }


        return $unit->get();
    }

    public function create($params = [])
    {
        // Insert Customer
        $unit = new MUnit();
        $unit->unit = $params['unit'];
        return $unit->save();
    }

    public function findById($id)
    {
        return MUnit::findOrFail($id);
    }

    public function findByUserId()
    {
        return MUnit::findOrFail(auth()->user()->group);
    }

    public function update($id, $params = [])
    {
        $unit = MUnit::findOrFail($id);
        $unit->unit = $params['unit'];
        return $unit->save();
    }

    public function delete($id)
    {
        $unit = MUnit::findOrFail($id);
        return $unit->forceDelete();
    }
}