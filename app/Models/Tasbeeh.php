<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasbeeh extends Model
{
    protected $table = 'tasbeeh_counter';
	protected $fillable = [
        'zikar','counter','lap','counted','total_count'
         ];
    use HasFactory;
    public $timestamps = true;
    protected $guarded = array();

    use HasFactory;
}
