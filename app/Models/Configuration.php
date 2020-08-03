<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Configuration
 * 
 * @property int $id
 * @property string $code
 * @property string $label
 * @property string $values
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Configuration extends Eloquent
{
	protected $fillable = [
		'code',
		'label',
		'values',
		'comment'
	];
}
