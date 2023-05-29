<?php

namespace App\Console\Commands;

use App\Models\Collaborator;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UploadCSVCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:save_csv_in_table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save upload file CSV in Table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tasks = Task::where('process', 'wait')->get();
        foreach ($tasks as $task) {
            $collaborators = [];
            $task->process = 'performed';
            $task->save();
            $fileStorageResource = fopen(base_path('/storage/app/'.$task->storage_file), 'r');
            if (!$fileStorageResource) {
                $task->process = 'error';
                $task->error = 'Ошибка открытия CSV файла';
                $task->save();
                continue;
            }
            while (($row = fgetcsv($fileStorageResource)) !== false) {
                if(count($row) == 0) continue;
                $collaborators[] = ['name' => $row[0]];
            }
            if($collaborators) {
                Collaborator::upsert($collaborators, ['name'], ['name']);
            }
            $task->process = 'completed';
            $task->save();
            fclose($fileStorageResource);
        }

        return Command::SUCCESS;
    }
}
