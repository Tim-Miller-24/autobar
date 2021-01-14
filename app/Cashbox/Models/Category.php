<?php

namespace App\Cashbox\Models;

use App\Cashbox\Scopes\Position;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Intervention\Image\ImageManagerStatic;
use App\Cashbox\Scopes\Active;
use App\Cashbox\Traits\HasTranslations;

class Category extends Model
{
    use HasFactory;
    use CrudTrait;
    use Active;
    use Position;
    use HasTranslations;

    // Set options for image attributes
    const DISK = 'public';
    const FIELD = 'image';
    const PATH = 'categories';
    const EXT = 'png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'css_class',
        'is_active',
        'lft',
        'rgt',
        'parent_id',
        'depth'
    ];

    protected $translatable = ['name', 'description'];

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
     * Get the items for the category.
     */
    public function items()
    {
        return $this->hasMany(Item::class, 'category_id', 'id')
            ->where('is_active', true)
            ->orderBy('position')->orderBy('name');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('lft');
    }

    public function scopeFirstLevelItems($query)
    {
        return $query->where('depth', '1')
            ->orWhere('depth', null)
            ->orderBy('lft');
    }

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
}
