<?php
namespace App\Cashbox\Models;

use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
    use \Spiritix\LadaCache\Database\LadaCacheTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'position',
        'is_active'
    ];

    protected $translatable = ['name'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */

    public $timestamps = true;

    public function values()
    {
        return $this->hasMany(AdditionValue::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'addition_items', 'addition_id', 'item_id');
    }
}
