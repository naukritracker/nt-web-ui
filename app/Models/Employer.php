<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employers';

    public function admin()
    {
        return $this->hasOne('App\Models\EmployerUser', 'id', 'admin_id');
    }
}