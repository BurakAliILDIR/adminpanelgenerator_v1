<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
  /**
   * Uygulamanız tarafından sağlanan Artisan komutları.
   */
  protected $commands = [
    // Özelleştirilmiş komutlar bu şekilde eklenir.
    Commands\CreateModule::class,
    Commands\RemoveModule::class,
    Commands\BuildProject::class,
  ];
  
  /**
   * Uygulamanın komut zamanlamasını tanımlayın.
   */
  protected function schedule(Schedule $schedule)
  {
    $schedule->command('backup:clean')->daily();
    $schedule->command('backup:run --only-db')->daily()->at('02:00');
    $schedule->command('backup:run --only-files')->monthly();
    $schedule->command('backup:run')->yearly();
    // $schedule->command('inspire')->hourly();
  }
  
  /**
   * Uygulama için komutları kaydedin.
   */
  protected function commands()
  {
    $this->load(__DIR__ . '/Commands');
    
    require base_path('routes/console.php');
  }
}
