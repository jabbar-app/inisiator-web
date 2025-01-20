<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'total_amount',
        'details',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'details' => 'array', // Automatically cast details to an array
    ];

    /**
     * Relationship to the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get a specific detail from the details array.
     *
     * @param string $key
     * @return mixed|null
     */
    public function getDetail($key)
    {
        return $this->details[$key] ?? null;
    }

    /**
     * Add or update a detail in the details array.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setDetail($key, $value)
    {
        $details = $this->details;
        $details[$key] = $value;
        $this->details = $details;
        $this->save();
    }

    /**
     * Add to total amount.
     *
     * @param float $amount
     * @return void
     */
    public function addAmount($amount)
    {
        $this->total_amount += $amount;
        $this->save();
    }

    /**
     * Subtract from total amount.
     *
     * @param float $amount
     * @return void
     */
    public function subtractAmount($amount)
    {
        $this->total_amount = max(0, $this->total_amount - $amount); // Ensure total_amount doesn't go negative
        $this->save();
    }
}
