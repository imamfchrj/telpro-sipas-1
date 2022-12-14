<?php

namespace Modules\Sipas\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MSuratkeluar extends Model
{
    use HasFactory;

    protected $fillable = [

    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'sipas_suratkeluar';
    protected $primaryKey = 'id';
    
    protected static function newFactory()
    {
        return \Modules\Sipas\Database\factories\MSuratkeluarFactory::new();
    }
}
