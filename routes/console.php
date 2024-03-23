<?php
declare(strict_types=1);

use App\Console\Commands\CleanTempFiles;
use Illuminate\Support\Facades\Schedule;

Schedule::command(CleanTempFiles::class)->everyMinute();


