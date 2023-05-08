<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Incident;
use App\Models\Post;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'urlavatar',
        'name',
        'address',
        'birth',
        'telephone',
        'email',
        'password',
    ];

    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relacion muchos a muchos, un usuario puede tener muchos roles
    public function roles()
    {
        return $this
            ->belongsToMany(Role::class)
            ->withTimestamps();
    }


    //metodos para comprobar si un usuario tiene un rol determinado
    public function authorizeRoles($roles)    
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    //relacion muchos a uno, un usuario puede tener muchos post
    public function posts()
    {
        return $this
            ->hasMany(Post::class);
    }

    //relacion muchos a uno, un usuario puede tener muchos incidentes
    public function incidents()
    {
        return $this
            ->hasMany(Incident::class);
    }
}
