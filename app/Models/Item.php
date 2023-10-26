<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Item
 *
 * @property int $id
 * @property int $SellerID
 * @property int $CategoryID
 * @property string $ItemName
 * @property string $Description
 * @property int $Price
 * @property string $Condition
 * @property string $UploadDate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $images
 * @property-read int|null $images_count
 * @property-read \App\Models\User $seller
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCategoryID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereItemName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereSellerID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUploadDate($value)
 * @mixin \Eloquent
 */
class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'SellerID',
        'CategoryID',
        'ItemName',
        'Description',
        'Price',
        'Location',
        'Condition',
        'Availability',
        'UploadDate',
    ];

    protected $primaryKey = 'id';
    public function seller()
    {
        return $this->belongsTo(User::class, 'SellerID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'ItemID');
    }
    public function itemcondition()
    {
        return $this->belongsTo(ItemConditions::class, 'Condition');
    }
    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'ItemID');
    }
}
