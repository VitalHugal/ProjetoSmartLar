<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enviroment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'status'];
    protected $table = 'enviroments';
    protected $dates = ['deleted_at'];

    public function rules()
    {
        return [
            'name' => 'required',
            'status' => 'in:0,1',
        ];
    }
    
    public function feedback()
    {
        return [
            'name.required' => 'Campo nome é obrigatório.',
            'status.in' => 'Valido apenas 0 ou 1 para esse campo.',
        ];
    }
}