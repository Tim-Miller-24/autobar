<?php

namespace App\Cashbox\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Intervention\Image\ImageManagerStatic;

class Option extends Model
{
    use HasFactory;
    use CrudTrait;

    // Set options for image attributes
    const DISK = 'public';
    const FIELD = 'image';
    const PATH = 'item_options';
    const EXT = 'png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'item_id',
        'note',
        'position',
        'price',
        'is_active'
    ];

    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            \Storage::disk(self::DISK)->delete($obj->{self::FIELD});
        });
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the item for the option.
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function scopeActive($query)
    {
        $query->where('is_active', true);
    }

//    public function stock()
//    {
//        return $this->incomes->sum('quantity') - $this->orders->sum('quantity');
//    }

    /**
     * Store image attribute
     */
    public function setImageAttribute($value)
    {
        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            \Storage::disk(self::DISK)->delete($this->{self::FIELD});

            // set null in the database column
            $this->attributes[self::FIELD] = null;
        }

        // if a base64 was sent, store it in the db
        if (\Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            $image = ImageManagerStatic::make($value)->encode(self::EXT, 90);

            // 1. Generate a filename.
            $filename = md5($value . time()) . '.' . self::EXT;

            // 2. Store the image on disk.
            \Storage::disk(self::DISK)->put(self::PATH . '/' . $filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            \Storage::disk(self::DISK)->delete($this->{self::FIELD});

            // 4. Save the public path to the database
            $this->attributes[self::FIELD] = self::PATH . '/' . $filename;
        }
    }

    public function getImageUrlAttribute()
    {
        return $this->image
            ? \Storage::disk(self::DISK)->url($this->image)
            : false;
    }

}
