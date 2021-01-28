<?php

namespace App\Cashbox\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Income extends Model
{
    use HasFactory;
    use CrudTrait;
    use \Spiritix\LadaCache\Database\LadaCacheTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'option_id',
        'quantity',
        'price'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function getAdvancedTitle()
    {
        $name = $this->item->name . ' ';
        $option = $this->option->name ?? '';
        return $name . $option;
    }
}
