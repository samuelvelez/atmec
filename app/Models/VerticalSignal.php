<?php

namespace App\Models;

use App\Traits\Reportable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class SignalsInventory
 * 
 * @property int $id
 * @property int $user_id
 * @property int $signal_id
 * @property float $latitude
 * @property float $longitude
 * @property string $picture
 * @property string $comment
 * @property string $orientation
 * @property string $google_address
 * @property string $street1
 * @property string $street2
 * @property string $neighborhood
 * @property string $state
 * @property string $normative
 * @property string $fastener
 * @property string $material
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\SignalInventory $vertical_signal
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class VerticalSignal extends Eloquent implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Reportable;

    protected $table = 'vertical_signals';

	protected $casts = [
		'user_id' => 'int',
		'signal_id' => 'int',
		'variation_id' => 'int',
		'latitude' => 'float',
		'longitude' => 'float'
	];

	protected $fillable = [
		'user_id',
		'signal_id',
		'variation_id',
        'code',
		'latitude',
		'longitude',
		'signal_folder',
		'picture',
		'comment',
		'orientation',
		'google_address',
		'street1',
		'street2',
		'neighborhood',
		'parish',
		'state',
		'normative',
		'fastener',
		'material',
        'erp_code',
        'unique_code',
	];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return array
     */
    public static function rules($merge = [])
    {
        return array_merge(
            [
                'code'   => 'required|min:3|max:50|unique:vertical_signals,code',
                'latitude'   => 'required|numeric',
                'longitude'  => 'required|numeric',
                'google_address' => 'required',
                'inventory' => 'required|numeric',
                'variation' => 'required|numeric',
                'orientation' => 'required',
                'state' => 'required',
                'normative' => 'required',
                'fastener' => 'required',
                'material' => 'required',
                //'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240'
                'picture_data' => 'required'
            ],
            $merge);
    }

	public function signal_inventory()
	{
		return $this->belongsTo(SignalInventory::class, 'signal_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function variation()
    {
        return $this->belongsTo(SignalVariation::class, 'variation_id');
    }

    public function reports()
    {
        return $this->morphToMany(Report::class, 'repairable');
    }

	public function get_picture_path()
    {
        $path = 'storage/signals/';

        if ($this->signal_folder) {
            $path .= $this->signal_folder . '/';
        }

        if ($this->picture) {
            $path .= $this->picture;
        }
        else {
            $path .= 'no-picture.png';
        }

        return $path;
    }
}
