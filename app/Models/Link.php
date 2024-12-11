<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
	use HasFactory;

	protected $fillable = ['url', 'http_response', 'response', 'frequency', 'retries', 'delay', 'status'];
}