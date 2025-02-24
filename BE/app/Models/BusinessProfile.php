<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_name',
        'category_id',
        'district',
        'latitude',
        'longitude',
        'opening_hour',
        'closing_hour',
        'main_img',
    ];

    public $timestamps = false;

    protected $appends = [
        'user_name',
    ];

    /**
     * Get the user associated with the business profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category associated with the business profile.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scopes

    /**
     * Scope a query to filter business profiles by district.
     */
    public function scopeByDistrict($query, $district)
    {
        return $query->where('district', $district);
    }

    /**
     * Scope a query to filter business profiles by category.
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Accessors

    /**
     * Get the user's name associated with the business profile.
     */
    public function getUserNameAttribute()
    {
        return $this->user ? $this->user->name : null;
    }
}
