<?php

namespace Modules\Sipas\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Kyslik\ColumnSortable\Sortable;

class MSuratmasuk extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Sortable;

    protected $fillable = [

    ];

    public $sortable = [
        'tanggal_terima', 'nomor_surat', 'perihal', 'dari', 'disposisi_name','status'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'sipas_suratmasuk';
    protected $primaryKey = 'id';
    
    protected static function newFactory()
    {
        return \Modules\Sipas\Database\factories\MSuratmasukFactory::new();
    }
}
