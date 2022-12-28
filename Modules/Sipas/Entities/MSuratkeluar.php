<?php

namespace Modules\Sipas\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;

class MSuratkeluar extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

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
