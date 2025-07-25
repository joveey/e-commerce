<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_price', 'status'];

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_COMPLETED = 'completed';

    public static function getStatusList()
    {
        return [
            self::STATUS_PENDING => 'Pesanan Diterima',
            self::STATUS_PROCESSING => 'Sedang Diproses',
            self::STATUS_SHIPPED => 'Pesanan Dikirim',
            self::STATUS_COMPLETED => 'Pesanan Selesai'
        ];
    }

    public function getStatusLabelAttribute()
    {
        return self::getStatusList()[$this->status] ?? $this->status;
    }

    public function canBeRated()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
