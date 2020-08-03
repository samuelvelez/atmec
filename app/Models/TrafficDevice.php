<?php

namespace App\Models;

use App\Traits\Reportable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class TrafficDevice
 *
 * @property int $id
 * @property int $user_id
 * @property int $traffictensor_id
 * @property int $trafficpole_id
 * @property int $regulatorbox_id
 * @property int $device_id
 * @property string $code
 * @property string $status
 * @property string $brand
 * @property string $model
 * @property string $comment
 * @property string $picture
 * @property string $erp_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\DeviceInventory $devices_inventory
 * @property \App\Models\RegulatorBox $regulator_box
 * @property \App\Models\TrafficPole $traffic_pole
 * @property \App\Models\TrafficTensor $traffic_tensor
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $traffic_lights
 *
 * @package App\Models
 */
class TrafficDevice extends Eloquent implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Reportable;

    const dev_types = [
        'ups_brands' => 'UPS',
        'travel_brands' => 'Tiempo de viaje',
        'energy_brands' => 'Fuente de poder',
        'mmu_brands' => 'MMU',
        'controller_brands' => 'Controlador (cerebro)'
    ];

    protected $table = 'traffic_devices';

    protected $casts = [
        'user_id' => 'int',
        'traffictensor_id' => 'int',
        'trafficpole_id' => 'int',
        'regulatorbox_id' => 'int',
        'device_id' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'traffictensor_id',
        'trafficpole_id',
        'regulatorbox_id',
        'device_id',
        'code',
        'state',
        'type',
        'brand',
        'model',
        'comment',
        'picture',
        'erp_code'
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
                'code' => 'max:50|unique:traffic_devices,code',
                'erp_code' => 'max:50',
                'regulator' => 'required|numeric',
                'state' => 'required|max:50',
                'brand' => 'max:50',
                'model' => 'max:50',
                'comment' => 'max:1024',
            ],
            $merge);
    }

    public function devices_type()
    {
        return $this->belongsTo(DeviceInventory::class, 'device_id');
    }

    public function regulator_box()
    {
        return $this->belongsTo(RegulatorBox::class, 'regulatorbox_id');
    }

    public function traffic_pole()
    {
        return $this->belongsTo(TrafficPole::class, 'trafficpole_id');
    }

    public function traffic_tensor()
    {
        return $this->belongsTo(TrafficTensor::class, 'traffictensor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function traffic_lights()
    {
        return $this->hasMany(TrafficLight::class, 'tlight_type_id');
    }

    public function reports()
    {
        return $this->morphToMany(Report::class, 'repairable');
    }
}
