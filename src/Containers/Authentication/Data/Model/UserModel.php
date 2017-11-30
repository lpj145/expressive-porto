<?php
namespace App\Containers\Authentication\Data\Model;

use App\Ship\Models\AbstractModel;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class UserModel extends AbstractModel
{
    use SoftDeletes;

    protected $primaryKey = 'username';
    protected $collection = 'users';

    protected $fillable = [
        'name', 'username', 'password',
        'abilities', 'active', 'remember_token'
    ];
}
