<?php

namespace App\Recommendations\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelsModel extends Model
{
    use HasFactory, HasUuids;
    
    protected $table = "channels";
    
    const CREATED_AT = null;
    
    const UPDATED_AT = null;
}
