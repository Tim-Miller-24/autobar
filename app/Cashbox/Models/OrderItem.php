<?php
namespace App\Cashbox\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
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
