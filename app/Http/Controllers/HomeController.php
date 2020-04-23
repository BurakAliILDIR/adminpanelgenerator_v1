<?php

namespace App\Http\Controllers;

use App\Charts\Echarts;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
  public function index()
  {
    $userCountChart = $this->userCountChart();
    
    return view('admin.home.index', compact('userCountChart'));
  }
  
  // yenş kullanıcı grafiği
  private function userCountChart()
  {
    $keys_path = config('cache.prefix') . ':home_new_user_count_keys';
    $values_path = config('cache.prefix') . ':home_new_user_count_values';
    if ( !($keys = unserialize(Redis::get($keys_path))) & !($values = unserialize(Redis::get($values_path)))) {
      $months = [null, 'Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];
      
      $users = User::selectRaw("year(created_at) as year, month(created_at) as month, count(*) as total")
        ->groupBy('year', 'month')->get();
      $users->first()->total -= 1;
      $date_user_count = [];
      foreach ($users as $item) {
        $date_user_count[$months[$item->month] . "/$item->year"] = $item->total;
      }
      $values = array_values($date_user_count);
      $keys = array_keys($date_user_count);
      Redis::set($keys_path, serialize($keys), 'EX', 3600);
      Redis::set($values_path, serialize($values), 'EX', 3600);
    }
    
    $chart = new Echarts();
    $name = 'Yeni Kullanıcı Sayısı';
    $chart->labels($keys);
    $chart->dataset($name, 'line', $values);
    $chart->options([
      "title" => [
        "text" => "Aylara Göre Yeni Kullanıcı Grafiği",
        "subtext" => "Mevcut Kullanıcı Sayısı : " . array_sum($values),
      ],
      "tooltip" => [
        "trigger" => "axis",
        "axisPointer" => [
          "type" => "cross",
          "label" => [
            "backgroundColor" => "#6a7985",
          ],
        ],
      ],
      "yAxis" => [
        [
          "type" => "value",
          'name' => 'Adet',
        ],
      ],
      "toolbox" => [
        "feature" => [
          "saveAsImage" => [],
        ],
      ],
      "grid" => [
        "left" => "3%",
        "right" => "3%",
        "bottom" => "3%",
        "containLabel" => true,
      ],
      "xAxis" => [
        [
          "type" => 'category',
          "boundaryGap" => false,
          "data" => $keys,
        ],
      ],
      
      "series" => [
        "name" => $name,
        "type" => "line",
        "areaStyle" => [],
        "data" => $values,
        "color" => '#65BD75',
      ],
    
    ]);
    
    return $chart;
  }
}
