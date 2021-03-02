<?php
namespace App\Cashbox\Models;

use App\Cashbox\Scopes\Position;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use App\Cashbox\Scopes\Active;
use App\Cashbox\Traits\HasTranslations;

class Addition extends Model
{
    use HasFactory;
    use CrudTrait;
    use Active;
    use Position;
    use HasTranslations;
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
