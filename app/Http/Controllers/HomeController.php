<?php

namespace App\Http\Controllers;

use App\Charts\Echarts;
use App\Charts\GraphicChart;
use App\Charts\Highcharts;
use App\Models\User;

class HomeController extends Controller
{
  public function index()
  {
    // TODO aylar yazılacak
    $userCountChart = $this->userCountChart();
    
    
    return view('admin.home.index', compact('userCountChart'));
  }
  
  private function userCountChart()
  {
    $chart = new Echarts();
    
    $months = [null, 'Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];
    
    $users = User::selectRaw("year(created_at) as year, month(created_at) as month, count(*) as total")
      ->groupBy('year', 'month')->limit(36)->get();
    $date_user_count = [];
    foreach ($users as $item) {
      $date_user_count[$months[$item->month] . "/$item->year"] = $item->total;
    }
    $values = array_values($date_user_count);
    $keys = array_keys($date_user_count);
    $name = 'Yeni Kullanıcı Sayısı';
    $chart->labels($keys);
    $chart->dataset($name, 'line', $values);
    /*$chart->height = 300;
        $chart->displayAxes(true);
    $chart->displayLegend(false);
    $chart->title('Cinsiyet Dağılımı');
    $chart->export(true, 'yeni');*/
    //$chart->theme = 'dark';
/*    $chart->options([
        "options3d" => [
          "enabled" => true,
          ],
    ]);*/
    
       $chart->options([
        "title" => [
          "text" => "Aylara Göre Yeni Kullanıcı Grafiği",
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
          "color" => '#65BD75'
        ],
      
      ]);
    /*->backGroundColor(['rgb(100, 100, 100, .4)', 'rgb(50, 150, 255, .4)', 'rgb(255, 100, 255, .4)'])
    ->color(['rgb(100, 100, 100, .4)', 'rgb(50, 150, 255, .4)', 'rgb(255, 100, 255, .4)']);*/
//    $chart->dataset('Kadın', 'pie', [$user_gender['Kadın']])->linetension(0)
//    ->backGroundColor('rgb(255, 100, 255, .4)')->color('rgb(255, 100, 255, .4)');
//    $chart->dataset('Belirtilmedi', 'pie', [$user_gender['Belirtilmedi']])->linetension(0)
//    ->backGroundColor('rgb(100, 100, 100, .4)')->color('rgb(100, 100, 100, .4)');
//      
    
    /* dd(array_sum($user_gender->values()));
     $chart->dataset('Belirtilmedi', 'bar', [array_sum($user_gender->values())])->linetension(0)
       ->backGroundColor('rgb(100, 100, 100, .4)')->color('rgb(100, 100, 100, .4)');*/
    /*$chart->dataset('Kullanıcı Sayısı', 'bar', array_values($numberOfUsersByYear));
    $chart->dataset('Erkek Sayısı', 'line', $user_male->values())->linetension(0)
      ->backGroundColor('rgb(50, 150, 255)')->color('rgb(50, 150, 255, .4)')->fill(false)->dashed([3]);
    $chart->dataset('Kadın Sayısı', 'line', $user_female->values())->linetension(0)
      ->backGroundColor('rgb(255, 100, 255)')->color('rgb(255, 99, 150, .4)')->fill(false)->dashed([3]);*/
    return $chart;
  }
}
