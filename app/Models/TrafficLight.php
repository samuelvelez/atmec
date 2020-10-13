<?php

namespace App\Models;

use App\Traits\Reportable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class TrafficLight
 *
 * @property int $id
 * @property int $user_id
 * @property int $tlight_type_id
 * @property int $interception_id
 * @property int $traffic_tensor_id
 * @property int $pole_id
 * @property int $regulatorbox_id
 * @property string $code
 * @property string $brand
 * @property string $model
 * @property string $status
 * @property string $picture
 * @property string $orientation
 * @property string $comment
 * @property string $erp_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\Intersection $intersection
 * @property \App\Models\TrafficPole $traffic_pole
 * @property \App\Models\RegulatorBox $regulator_box
 * @property \App\Models\TrafficDevice $traffic_device
 * @property \App\Models\TrafficTensor $traffic_tensor
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class TrafficLight extends Eloquent implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Reportable;

    protected $casts = [
        'user_id' => 'int',
        'type_id' => 'int',
        'intersection_id' => 'int',
        'tensor_id' => 'int',
        'pole_id' => 'int',
        'regulator_id' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'type_id',
        'intersection_id',
        'tensor_id',
        'pole_id',
        'regulator_id',
        'code',
        'brand',
        'model',
        'state',
        'light_folder',
        'picture',
        'orientation',
        'fastener',
        'comment',
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
                //'code'   => 'required|min:1|max:50|unique:traffic_lights,code',
                'code' => 'max:50|unique:traffic_lights,code',
                'erp_code' => 'max:50',
                'light_type' => 'required|numeric',
                'intersection' => 'required|numeric',
                'regulator' => 'required|numeric',
                'brand' => 'required|max:50',
                'state' => 'required|max:50',
                'picture' => 'required',
                'orientation' => 'required|max:50',
                'fastener' => 'max:50',
                'comment' => 'max:1024',
            ],
            $merge);
    }

    public function intersection()
    {
        return $this->belongsTo(\App\Models\Intersection::class, 'intersection_id');
    }

    public function traffic_pole()
    {
        return $this->belongsTo(\App\Models\TrafficPole::class, 'pole_id');
    }

    public function regulator()
    {
        return $this->belongsTo(\App\Models\RegulatorBox::class, 'regulator_id');
    }

    public function light_type()
    {
        return $this->belongsTo(\App\Models\TrafficLightType::class, 'type_id');
    }

    public function traffic_tensor()
    {
        return $this->belongsTo(\App\Models\TrafficTensor::class, 'tensor_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function reports()
    {
        return $this->morphToMany(Report::class, 'repairable');
    }

    public function get_picture_path()
    {
        $path = 'storage/lights/';

        if ($this->light_folder) {
            $path .= $this->light_folder . '/';
        }

        if ($this->picture) {
            $path .= $this->picture;
        } else {
            $path .= 'no-picture.png';
        }

        return $path;
    }
}
