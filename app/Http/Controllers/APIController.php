<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use App\Models\Mqtt;
use App\Models\Room;
use App\Models\Device;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Models\PowerMonitoring;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    public function countData()
    {
        $room       = Room::get()->count();
        $category   = Category::get()->count();
        $feature    = Feature::get()->count();

        return response()->json([
            [
                "room"      => $room,
                "category"  => $category,
                "feature"   => $feature,
            ]
        ]);
    }

    /**
     * M Q T T
     */

    public function getMQTT()
    {
        $data = Mqtt::select('uuid', 'host', 'username', 'password', 'port')->get();

        return $data;
    }

    public function updateMQTT(Request $request, $uuid)
    {
        $host       = $request->input('host');
        $username   = $request->input('username');
        $password   = $request->input('password');
        $port       = $request->input('port');

        $check  = Mqtt::where('uuid', $uuid)->update([
                    'host'      => $host,
                    'username'  => $username,
                    'password'  => $password,
                    'port'      => $port,
                  ]);

        if ( $check ) {
            $result = response()->json(['success' => true], 200);
        } else {
            $result = response()->json(['success' => false], 500);
        }

        return $result;
    }
    
    /**
     * M Q T T
     */


    /**
     * R O O M S
     */

    public function getRooms()
    {
        $data = Room::select('room.uuid', 'name_room')
                    ->selectRaw('COUNT(device.id_room) as available_devices')
                    ->leftJoin('device', 'device.id_room', 'room.uuid')
                    ->groupBy('room.uuid')
                    ->orderBy('room.id')
                    ->get();

        return $data;
    }

    public function getDetailRooms($uuid)
    {
        $data = Room::select('room.uuid', 'name_room')
                    ->where('uuid', $uuid)
                    ->first();

        return [$data];
    }

    public function storeRooms(Request $request)
    {
        $name_room  = $request->input('name_room');

        $check  = Room::create([
                    'name_room'  => $name_room,
                  ]);

        if ( $check ) {
            $result = response()->json(['success' => true], 200);
        } else {
            $result = response()->json(['success' => false], 500);
        }

        return $result;
    }

    public function deleteRooms($uuid)
    {
        $check = Room::where('uuid', $uuid)->delete();
        Device::where('id_room', $uuid)->delete();

        if ( $check ) {
            $result = response()->json(['success' => true], 200);
        } else {
            $result = response()->json(['success' => false], 500);
        }

        return $result;
    }

    public function updateRooms(Request $request, $uuid)
    {
        $name_room  = $request->input('name_room');

        $check  = Room::where('uuid', $uuid)->update([
                    'name_room'  => $name_room,
                  ]);

        if ( $check ) {
            $result = response()->json(['success' => true], 200);
        } else {
            $result = response()->json(['success' => false], 500);
        }

        return $result;
    }

    /**
     * R O O M S
     */


     /**
     * C A T E G O R I E S
     */

    public function getCategory()
    {
        $data = Category::select('categories.uuid', 'name_category')
                    ->orderBy('categories.id')
                    ->get();

        return $data;
    }

    public function getDetailCategory($uuid)
    {
        $data = Category::select('categories.uuid', 'name_category')
                    ->where('uuid', $uuid)
                    ->first();

        return [$data];
    }

    public function storeCategory(Request $request)
    {
        $name_category  = $request->input('name_category');

        $check  = Category::create([
                    'name_category'  => $name_category,
                  ]);

        if ( $check ) {
            $result = response()->json(['success' => true], 200);
        } else {
            $result = response()->json(['success' => false], 500);
        }

        return $result;
    }

    public function deleteCategory($uuid)
    {
        $check      = Category::where('uuid', $uuid)->delete();
        $id_feature = Feature::where('id_categories', $uuid)->first()->uuid ?? '';
        
        if ($id_feature != '') {
            Feature::where('id_categories', $uuid)->delete();
            Device::where('id_feature', $id_feature)->delete();
        }

        if ( $check ) {
            $result = response()->json(['success' => true], 200);
        } else {
            $result = response()->json(['success' => false], 500);
        }

        return $result;
    }

    public function updateCategory(Request $request, $uuid)
    {
        $name_category  = $request->input('name_category');

        $check  = Category::where('uuid', $uuid)->update([
                    'name_category'  => $name_category,
                  ]);

        if ( $check ) {
            $result = response()->json(['success' => true], 200);
        } else {
            $result = response()->json(['success' => false], 500);
        }

        return $result;
    }

    /**
     * C A T E G O R I E S
     */


    /**
     * F E A T U R E S
     */

    public function getFeatures()
    {
        $data = Feature::select('id', 'uuid', 'id_categories', 'name_feature')
                    ->get();

        return $data;
    }

    public function getDetailFeatures($uuid)
    {
        $data = Feature::select('feature.id', 'feature.uuid', 'feature.id_categories', 'name_category', 'name_feature')
                    ->join('categories', 'categories.uuid', 'feature.id_categories')
                    ->where('feature.uuid', $uuid)
                    ->first();

        return [$data];
    }
  
    public function storeFeatures(Request $request)
    {
        $name_category  = $request->input('id_categories');
        $id_categories  = Category::where('name_category', $name_category)->first()->uuid;
        $name_feature   = $request->input('name_feature');

        $check  = Feature::create([
            'id_categories' => $id_categories,
            'name_feature'  => $name_feature,
        ]);

        if ( $check ) {
            $result = response()->json(['success' => true], 200);
        } else {
            $result = response()->json(['success' => false], 500);
        }

        return $result;
    }

    public function deleteFeatures($uuid)
    {
        $check = Feature::where('uuid', $uuid)->delete();
        Device::where('id_feature', $uuid)->delete();

        if ( $check ) {
            $result = response()->json(['success' => true], 200);
        } else {
            $result = response()->json(['success' => false], 500);
        }

        return $result;
    }

    public function updateFeatures(Request $request, $uuid)
    {
        $name_category  = $request->input('id_categories');
        $id_categories  = Category::where('name_category', $name_category)->first()->uuid;
        $name_feature  = $request->input('name_feature');

        $check  = Feature::where('uuid', $uuid)->update([
                    'id_categories' => $id_categories,
                    'name_feature'  => $name_feature,
                  ]);

        if ( $check ) {
            $result = response()->json(['success' => true], 200);
        } else {
            $result = response()->json(['success' => false], 500);
        }

        return $result;
    }

    /**
     * F E A T U R E S
     */
    

    /**
     * D E V I C E S
     */

    public function getDetailDevices($uuid)
    {
        $data = Device::select('device.id', 'device.uuid', 'device.id_room', 'device.id_feature', 'device.name_device', 'topic', 'retain', 'active', 'inactive', 'feature.name_feature')
                    ->join('feature', 'feature.uuid', 'device.id_feature')
                    ->where('device.uuid', $uuid)
                    ->first();

        return [$data];
    }

    public function getDevices($uuidRoom, $category)
    {
        switch ($category) {
            case 'power':
                $data = Device::select('device.id', 'device.uuid', 'device.name_device', 'device.topic', 'device.retain', 'room.name_room', 'feature.name_feature', 'device.active', 'device.inactive')
                    ->join('room', 'room.uuid', 'device.id_room')
                    ->join('feature', 'feature.uuid', 'device.id_feature')
                    ->join('categories', 'categories.uuid', 'feature.id_categories')
                    ->where('device.id_room', $uuidRoom)
                    ->where('categories.name_category', 'POWER')
                    ->orderBy('device.id', 'ASC')
                    ->get();
                break;
            
            case 'remote':
                $data = Device::select('device.id', 'device.uuid', 'device.name_device', 'device.topic', 'device.retain', 'room.name_room', 'feature.name_feature', 'device.active')
                    ->join('room', 'room.uuid', 'device.id_room')
                    ->join('feature', 'feature.uuid', 'device.id_feature')
                    ->join('categories', 'categories.uuid', 'feature.id_categories')
                    ->where('device.id_room', $uuidRoom)
                    ->where('categories.name_category', 'REMOTE')
                    ->orderBy('device.id', 'ASC')
                    ->get();
                break;

            case 'sensor-th':
                $data = Device::select('device.id', 'device.uuid', 'device.name_device', 'device.topic', 'device.retain', 'room.name_room', 'feature.name_feature')
                    ->join('room', 'room.uuid', 'device.id_room')
                    ->join('feature', 'feature.uuid', 'device.id_feature')
                    ->join('categories', 'categories.uuid', 'feature.id_categories')
                    ->where('device.id_room', $uuidRoom)
                    ->where('categories.name_category', 'SENSOR TH')
                    ->orderBy('device.id', 'ASC')
                    ->get();
                break;

            case 'monitoring':
                $data = Device::select('device.id', 'device.uuid', 'device.name_device', 'device.topic', 'device.retain', 'room.name_room', 'feature.name_feature')
                    ->join('room', 'room.uuid', 'device.id_room')
                    ->join('feature', 'feature.uuid', 'device.id_feature')
                    ->join('categories', 'categories.uuid', 'feature.id_categories')
                    ->where('device.id_room', $uuidRoom)
                    ->where('categories.name_category', 'KWH MONITORING')
                    ->orderBy('device.id', 'ASC')
                    ->get()
                    ->map(function ($devices, $roomUuid) {
                        return ['device' => $devices->toArray()];
                    })
                    ->values()
                    ->toArray();
                break;

            default:
                $data = response()->json(array('message' => '404 Not Found'));
                break;
        }

        return $data;
    }

    public function storeDevices(Request $request)
    {
        $name_feature   = $request->input('name_feature');
        $id_feature     = Feature::where('name_feature', $name_feature)->first()->uuid;
        $id_room        = $request->input('id_room');
        $name_device    = $request->input('name_device');
        $topic          = $request->input('topic');
        $active         = $request->input('active');
        $inactive       = $request->input('inactive');

        $check = Device::create([
            'id_room'       => $id_room,
            'id_feature'    => $id_feature,
            'name_device'   => $name_device,
            'topic'         => $topic,
            'retain'        => "true",
            'active'        => $active,
            'inactive'      => $inactive,
        ]);

        if ( $check ) {
            $result = response()->json(['success' => true], 200);
        } else {
            $result = response()->json(['success' => false], 500);
        }

        return $result;
    }

    public function deleteDevices($uuid)
    {
        $check = Device::where('uuid', $uuid)->delete();

        if ( $check ) {
            $result = response()->json(['success' => true], 200);
        } else {
            $result = response()->json(['success' => false], 500);
        }

        return $result;
    }

    public function updateDevices(Request $request, $id)
    {
        $name_feature   = $request->input('name_feature');
        $id_feature     = Feature::where('name_feature', $name_feature) 
                            ->first()
                            ->uuid;
        $id_room        = $request->input('id_room');
        $name_device    = $request->input('name_device');
        $topic          = $request->input('topic');
        $active         = $request->input('active');
        $inactive       = $request->input('inactive');

        $check = Device::where('id', $id)->update([
            'id_room'       => $id_room,
            'id_feature'    => $id_feature,
            'name_device'   => $name_device,
            'topic'         => $topic,
            'retain'        => "true",
            'active'        => $active,
            'inactive'      => $inactive,
        ]);

        if ( $check ) {
            $result = response()->json(['success' => true], 200);
        } else {
            $result = response()->json(['success' => false], 500);
        }

        return $result;
    }

    /**
     * D E V I C E S
     */


    public function storePowerMonitor(Request $request)
    {
        $today      = date('Y-m-d');
        $checkData  = PowerMonitoring::where(DB::raw('DATE(created_at)'), $today)
                        ->where('id_room', $request->input('id_room'))
                        ->first();

        if ( $request->input('energy') != $checkData->energy ) // conditioning, energy is same or not
        {
            if ( $checkData ) // conditioning, data in database today except or not
            {
                $data   = PowerMonitoring::where('id_room', $request->input('id_room'))
                            ->update($request->all());
            } else 
            {
                $data   = PowerMonitoring::create($request->all());
            }
    
            if ( $data )  // conditioning, the data was successfully inserted or updated or not 
            {
                $result = response()->json(['success' => true], 200);
            } else 
            {
                $result = response()->json(['success' => false], 500);
            }
        } else 
        {
            $result = response()->json(['message' => 'Cant insert into the database, because the energy is the same'], 200);
        }

        return $result;
    }

    public function getPowerMonitor($uuidRoom, $category)
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();

        switch ($category) {
            case 'weekly':
                $week = [
                    ['energy' => '0.00', 'date' => 'Mon'],
                    ['energy' => '0.00', 'date' => 'Tue'],
                    ['energy' => '0.00', 'date' => 'Wed'],
                    ['energy' => '0.00', 'date' => 'Thu'],
                    ['energy' => '0.00', 'date' => 'Fri'],
                    ['energy' => '0.00', 'date' => 'Sat'],
                    ['energy' => '0.00', 'date' => 'Sun'],
                ];

                $dataTable = PowerMonitoring::select('energy', DB::raw("DATE_FORMAT(updated_at, '%a') as date"))
                            ->where('id_room', $uuidRoom)
                            ->whereBetween('updated_at', [$startOfWeek, $endOfWeek])
                            ->get();

                foreach ($dataTable as $d) {
                    $index = array_search($d->date, array_column($week, 'date'));
                    $week[$index]['energy'] = $d->energy;
                }
                
                $data = [];
                foreach ($week as $b) {
                    $data[] = $b;
                }
                
                $data = collect($data)->map(function ($item) {
                    return [
                        'energy' => number_format($item['energy'], 2),
                        'date' => $item['date'],
                    ];
                });
                break;
            
            case 'monthly':
                
                $lastDay = date('t');   

                $tanggal = [];
                for ($i = 1; $i <= $lastDay; $i++) {
                    $date = str_pad($i, 2, '0', STR_PAD_LEFT);
                    $tanggal[] = [
                        'energy' => '0.00',
                        'date' => $date
                    ];
                }
                
                $dataTable = PowerMonitoring::select('energy', DB::raw('CAST(DAY(updated_at) AS CHAR) as date'))
                            ->where('id_room', $uuidRoom)
                            ->whereMonth('updated_at', date('m'))
                            ->get();
                
                foreach ($dataTable as $d) {
                    $index = array_search($d->date, array_column($tanggal, 'date'));
                    $tanggal[$index]['energy'] = $d->energy;
                }
                
                $data = [];
                foreach ($tanggal as $b) {
                    $data[] = $b;
                }
                
                $data = collect($data)->map(function ($item) {
                    return [
                        'energy' => number_format($item['energy'], 2),
                        'date' => $item['date'],
                    ];
                });
                break;   
                
            case 'yearly':
                $bulan = [
                    ['energy' => '0.00', 'date' => 'Jan'],
                    ['energy' => '0.00', 'date' => 'Feb'],
                    ['energy' => '0.00', 'date' => 'Mar'],
                    ['energy' => '0.00', 'date' => 'Apr'],
                    ['energy' => '0.00', 'date' => 'May'],
                    ['energy' => '0.00', 'date' => 'Jun'],
                    ['energy' => '0.00', 'date' => 'Jul'],
                    ['energy' => '0.00', 'date' => 'Aug'],
                    ['energy' => '0.00', 'date' => 'Sep'],
                    ['energy' => '0.00', 'date' => 'Oct'],
                    ['energy' => '0.00', 'date' => 'Nov'],
                    ['energy' => '0.00', 'date' => 'Dec'],
                ];
                
                $dataTable = PowerMonitoring::select(DB::raw('SUM(energy) as energy'), DB::raw("CAST(DATE_FORMAT(updated_at, '%b') AS CHAR) as date"))
                    ->where('id_room', $uuidRoom)
                    ->whereBetween(DB::raw('MONTH(updated_at)'), [1, 12])
                    ->groupBy(DB::raw("CAST(DATE_FORMAT(updated_at, '%b') AS CHAR)"))
                    ->get();
                
                foreach ($dataTable as $d) {
                    $index = array_search($d->date, array_column($bulan, 'date'));
                    $bulan[$index]['energy'] = $d->energy;
                }
                
                $data = [];
                foreach ($bulan as $b) {
                    $data[] = $b;
                }
                
                $data = collect($data)->map(function ($item) {
                    return [
                        'energy' => number_format($item['energy'], 2),
                        'date' => $item['date'],
                    ];
                });
                break;

            default:
                break;
        }

        return $data;
    }
}
