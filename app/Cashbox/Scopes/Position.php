<?php

namespace App\Cashbox\Scopes;


trait Position
{
    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePosition($query)
    {
        return $query->orderBy('position');
    }
}
