<?php

namespace App\Cashbox\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class OrderFilter extends Filter
{
    /**
     * Filter the products by the given string.
     *
     * @param  string|null  $value
     * @return \Illuminate\Database\Eloquent\Builder OR void
     */
    public function date_from(string $value = null): Builder
    {
        if($value) {
            return $this->builder->where('order_items.created_at', '>=', "{$value}");
        }

        return $this->builder;
    }

    /**
     * Filter the products by the given string.
     *
     * @param  string|null  $value
     * @return \Illuminate\Database\Eloquent\Builder OR void
     */
    public function date_to(string $value = null): Builder
    {
        if($value) {
            return $this->builder->where('order_items.created_at', '<=', "{$value}");
        }

        return $this->builder;
    }

    /**
     * Filter the products by the given string.
     *
     * @param  string|null  $value
     * @return \Illuminate\Database\Eloquent\Builder OR void
     */
    public function user_id(string $value = null): Builder
    {
        if($value) {
            return $this->builder->where('orders.user_id', '=', "{$value}");
        }

        return $this->builder;
    }
}