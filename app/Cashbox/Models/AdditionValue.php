<?php
namespace App\Cashbox\Models;

use App\Cashbox\Scopes\Position;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use App\Cashbox\Scopes\Active;
use App\Cashbox\Traits\HasTranslations;

class AdditionValue extends Model
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
        'id',
        'name',
        'position',
        'is_active',
        'addition_id'
    ];

    protected $translatable = ['name'];

    public function addition()
    {
        return $this->belongsTo(Addition::class, 'addition_id', 'id');
    }
}
