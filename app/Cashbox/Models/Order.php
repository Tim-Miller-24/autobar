<?php

namespace App\Cashbox\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Traversable;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    use HasFactory;
    use CrudTrait;

    const STATUS_PENDING = 'pending';
    const STATUS_CANCEL = 'cancel';
    const STATUS_FINISH = 'finish';

    const CACHE_KEY = 'order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'paid',
        'status'
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the items for the category.
     */
    public function getItems(): Traversable
    {
        return $this->items;
    }

    public function scopePending(Builder $query)
    {
        return $query->whereIn('status', [Order::STATUS_PENDING]);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function total()
    {
        return $this->items->sum('total');
    }
}
