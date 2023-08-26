<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];// irá ser enviado qualquer coisa != de ID
    public function items(){
        return $this->hasMany(Inventory::class);
    }
}
