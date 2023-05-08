<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'description',
        'state',
        'answer',
    ];

    //relacion muchos a uno, un incidente pertenece a un usuario
    public function user()
    {
        return $this
            ->belongsTo(User::class, 'user_id');
    }
}
