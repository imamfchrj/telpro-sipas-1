<?php
/**
 * Created by PhpStorm.
 * User: IT TELPRO
 * Date: 23/10/2022
 * Time: 17:31
 */

namespace Modules\Jib\Repositories\Admin\Interfaces;


interface PersetujuanRepositoryInterface
{
    public function create($params = []);
    public function findAllbyPengId($id);
    public function findById($id);
    public function findbyPengId($id);
    public function update($id, $params = []);
}