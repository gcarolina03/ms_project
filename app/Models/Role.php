<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

    //relacion muchos a muchos, un rol puede tener muchos usuarios
    public function users()
    {
        return $this
            ->belongsToMany(User::class, 'user_id')
            ->withTimestamps();
    }


}
