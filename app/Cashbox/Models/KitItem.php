<?php
namespace App\Cashbox\Models;

use Illuminate\Database\Eloquent\Model;
use App\Cashbox\Traits\Filterable;

class KitItem extends Model
{
    use Filterable;
    use \Spiritix\LadaCache\Database\LadaCacheTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
