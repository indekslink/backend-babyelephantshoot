<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldUser extends Model
{
    use HasFactory;
    protected $table = 'field_user';

    protected $fillable = [
        'user_id',
        'no_ktp',
        'alamat',
        'no_hp',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
