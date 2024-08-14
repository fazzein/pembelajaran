<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Scaffolding\Traits\ScaffoldingModel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    protected $guarded = ['id'];
    use HasFactory, ScaffoldingModel;

    public function __construct(array $attributes = [])
    {
        $this->initialize();
        parent::__construct($attributes);
    }
}
