<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Src\Auth\IdentityInterface;

class User extends Model implements IdentityInterface
{
    use HasFactory;

    public $timestamps = false;
    // Указываем название первичного ключа
    protected $primaryKey = 'UserID';

    protected $fillable = [
        'login',
        'password',
    ];

    // Реализация методов интерфейса

    public function findIdentity(int $id)
    {
        return self::find($id);
    }

    public function getId(): int
    {
        return $this->UserID;
    }

    public function attemptIdentity(array $credentials)
    {
        return self::where('Login', $credentials['login'])
            ->where('Password', md5($credentials['password']))
            ->first();
    }
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'userrole','UserID', 'RoleID');
    }


}
