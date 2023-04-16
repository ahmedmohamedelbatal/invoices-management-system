<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['section_name', 'section_description'];

    public function product() {
        return $this->hasOne(Product::class);
    }

    public function invoice() {
        return $this->hasOne(Invoice::class);
    }
}
