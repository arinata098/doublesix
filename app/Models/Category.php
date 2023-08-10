<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'idCategory';

    protected $fillable = [
        'idDept',
        'cateName',
        'description',
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function department()
    {
        return $this->belongsTo(Department::class, 'idDept', 'idDept');
    }
}
