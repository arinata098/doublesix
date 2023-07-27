<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    protected $table = 'work_orders';
    protected $primaryKey = 'idWorkOrder';

    protected $fillable = [
        'workOrderName',
        'userId',
        'fromDept',
        'toDept',
        'idCategory',
        'idLocation',
        'startWorkOrder',
        'endWorkOrder',
        'estimate',
        'description',
        'status',
        'completeBy',
        'photo',
        'note',
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function deptFrom()
    {
        return $this->belongsTo(Department::class, 'fromDept', 'idDept');
    }

    public function deptTo()
    {
        return $this->belongsTo(Department::class, 'toDept', 'idDept');
    }

    public function categoryWo()
    {
        return $this->belongsTo(Category::class, 'idCategory', 'idCategory');
    }

    public function locationWo()
    {
        return $this->belongsTo(Location::class, 'idLocation', 'idLocation');
    }

    public function userWo()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
