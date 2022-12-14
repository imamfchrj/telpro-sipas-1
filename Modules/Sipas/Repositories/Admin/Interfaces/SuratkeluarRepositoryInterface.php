<?php
/**
 * Created by PhpStorm.
 * User: IT TELPRO
 * Date: 12/12/2022
 * Time: 00:58
 */

namespace Modules\Sipas\Repositories\Admin\Interfaces;


interface SuratkeluarRepositoryInterface
{
    public function findAll($options = []);
    public function create($params = []);
    public function findById($id);
    public function update($id, $params = []);
    public function delete($id);
}