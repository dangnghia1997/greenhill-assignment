<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Interfaces\TempFileRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CleanTempFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-temp-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used for cleaning temp files';

    public function __construct(
        private TempFileRepositoryInterface $tempFileRepository
    )
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = $this->tempFileRepository->all();

        if (!$files->count()) {
            $this->info('NO FILES TO CLEAN');
            return;
        }

        foreach ($files as $file) {
            $path = Storage::path($file->path);
            $deleted = File::delete($path);
            if ($deleted) {
                $this->info('REMOVE FILE: ' . $path);
                $this->tempFileRepository->delete((int)$file->id);
                $this->info('DELETE RECORD: ID = ' . (int)$file->id);
            }
        }
    }
}
