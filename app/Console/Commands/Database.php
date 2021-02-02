<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Database extends Command
{
    protected $signature = 'backup:db';

    protected $description = 'Backup the database';

    protected $process;

    protected $fileName;

    public function __construct()
    {

        parent::__construct();
    }

    public function handle()
    {
        $this->backup();
        $this->gzip();
        $this->copyToS3();
    }

    private function backup()
    {
        $this->fileName = date('YmdHis');

        $this->process = new Process(sprintf(
            'mysqldump -u%s -p%s %s > %s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.database'),
            storage_path('backups/' . $this->fileName . '.sql')
        ));

        try {
            $this->process->mustRun();
            $this->info('The backup has been proceed successfully.');
        } catch (ProcessFailedException $exception) {
            $this->error('The backup process has been failed.');
            $this->info($exception->getMessage());
        }
    }

    private function gzip()
    {
        $fp = gzopen(storage_path('backups/' . $this->fileName . '.gz'), 'w9');
        gzwrite($fp, file_get_contents(storage_path('backups/' . $this->fileName . '.sql')));
        gzclose($fp);
    }

    private function copyToS3()
    {
        $path = storage_path('backups/' . $this->fileName . ".gz");
        $disk = Storage::disk('s3_backup');

        if (!$disk->exists('dbs/' . $this->fileName . ".gz")) {
            $disk->put('dbs/' . $this->fileName . ".gz", file_get_contents($path));
            $this->info('plik leci');
        } else {
            $this->info('plik nie leci bo jest');
        }

        $this->info($path);
    }
}