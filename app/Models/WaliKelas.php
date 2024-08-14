<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Scaffolding\Traits\ScaffoldingModel;

class WaliKelas extends Model
{
    use HasFactory, ScaffoldingModel;
    protected $table = 'wali_kelas';
    protected $guarded = ['id'];

    public function __construct(array $attributes = [])
    {
        $this->initialize();
        parent::__construct($attributes);
    }
}
