<?php
/**
 * Created by PhpStorm.
 * User: IT TELPRO
 * Date: 12/12/2022
 * Time: 11:19
 */

namespace Modules\Sipas\Repositories\Admin\Interfaces;


interface UnitRepositoryInterface
{
    public function findAll($options = []);
    public function create($params = []);
    public function findById($id);
    public function findByUserId();
    public function update($id, $params = []);
    public function delete($id);
}