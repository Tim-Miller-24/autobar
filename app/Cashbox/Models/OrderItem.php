<?php
namespace App\Cashbox\Models;

use Illuminate\Database\Eloquent\Model;
use App\Cashbox\Traits\Filterable;

class OrderItem extends Model
{
    use Filterable;
    use \Spiritix\LadaCache\Database\LadaCacheTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function purchaseTotal()
    {
        if($this->option) {
            return $this->option->incomes->avg('price') * $this->quantity;
        }

        return $this->item->incomes->avg('price') * $this->quantity;
    }

    public function profit()
    {
        return $this->total() - $this->purchaseTotal();
    }

    public function total()
    {
        return $this->price * $this->quantity;
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function getPurchasePriceAttribute()
    {
        $incomes = $this->option_id ? $this->option->incomes : $this->item->incomes;

        $count = $this->option_id ?
            $this->option->orders->where('created_at', '<', $this->created_at)->sum('quantity') :
            $this->item->orders->where('created_at', '<', $this->created_at)->sum('quantity');

        $income_qty = 0;

        foreach($incomes as $income) {
            if(($income_qty += $income->quantity) >= $count) {
                return $income->price;
            }
        }
    }

    /**
     * Property accessor alias to the total() method
     *
     * @return float
     */
    public function getTotalAttribute()
    {
        return $this->total();
    }

    public function getProfitAttribute()
    {
        return $this->profit();
    }
}
