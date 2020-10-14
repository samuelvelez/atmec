<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
/**
 * Class DevicesInventory
 * 
 * @property int $id
 * @property string $storage_id
 * @property string $device_id
 * @property string $quantity
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 *
 * @package App\Models
 */
class StorageInventory extends Eloquent
{
	protected $table = 'storage_inventory';

	protected $fillable = [
		'storage_id',
		'device_id',
		'quantity',
	];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return array
     */
    
    public function device()
	{
		return $this->hasOne(DevicesInventory::class, 'id');
    }
    public function storage()
	{
		return $this->hasOne(Storage::class, 'id');
	}

        public function devices()
    {
        return $this->hasMany(DevicesInventory::class, 'device_id');
    }
        
        
}
