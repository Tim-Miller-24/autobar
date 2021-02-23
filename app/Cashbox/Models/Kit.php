<?php

namespace App\Cashbox\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    use HasFactory;

    const DISK = 'public';
    const FIELD = 'image';
    const PATH = 'kits';
    const EXT = 'png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'position',
        'is_active',
        'option_name'
    ];

    protected $translatable = ['name'];

    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            \Storage::disk(self::DISK)->delete($obj->{self::FIELD});
        });
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'kit_items', 'kit_id', 'item_id');
    }
}
