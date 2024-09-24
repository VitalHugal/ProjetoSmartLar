<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LightBuld extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'status'];
    protected $table = 'light_bulds';
    protected $dates = ['deleted_at'];

    public function rules()
    {
        return [
            'name' => 'required|',
            'status' => '|in:0,1'
        ];
    }

    public function feedback()
    {
        return [
            'name.required' => 'Campo nome obrigatório.',
            'status.in' => 'Válido apenas 0 ou 1 nesse campo.',
        ];
    }
}