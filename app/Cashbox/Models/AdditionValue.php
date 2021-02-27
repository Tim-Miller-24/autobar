<?php
namespace App\Cashbox\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionValue extends Model
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

    public function addition()
    {
        return $this->belongsTo(Addition::class, 'id', 'addition_id');
    }
}
