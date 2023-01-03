<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TvCategory;
class TvChannel extends Model
{
    protected $table="tv_channels";
    protected $fillable=[
        'channel_name',
        'channel_img',
        'category_id',
        'channel_url',
    ];

    public function tvCategory(){
        return $this->belongsTo(TvCategory::class, 'category_id', 'id');
    }
}
