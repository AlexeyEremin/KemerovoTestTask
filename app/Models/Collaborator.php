<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function WorkTime()
    {
        return $this->hasMany(WorkTime::class);
    }

    public function isOpenWorkTime()
    {
        return $this->WorkTime()->whereNull('end')->exists();
    }
}
