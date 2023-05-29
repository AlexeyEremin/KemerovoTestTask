<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadCSVRequest;
use App\Models\Collaborator;
use App\Models\Task;
use Carbon\Carbon;

class CollaboratorController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\Vie
     */
    public function getList()
    {
        $collaborators = Collaborator::paginate(15);

        return view('collaborator.list', compact('collaborators'));
    }

    /**
     * @param  UploadCSVRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadCSV(UploadCSVRequest $request)
    {
        $status = $request->file('csv_file')->store('file-csv');
        if (!$status) {
            return back()->with('not_success', 'Ошибка загрузки файла в систему!');
        }
        Task::create(['storage_file' => $status]);
        exec('php '.base_path().'/artisan command:save_csv_in_table > &');

        return back()->with('success', 'Операция успешно выполнена! Файл загружен, ожидайте выполнения!');
    }

    public function getReport(Collaborator $collaborator, int $week)
    {
        $date = Carbon::now();
        $date->setISODate(2023, $week);
        $time = $collaborator->WorkTime()->whereBetween(
            'start',
            [$date->copy()->startOfWeek(), $date->copy()->endOfWeek()]
        )->selectRaw('SEC_TO_TIME(SUM(TIMESTAMPDIFF(SECOND, start, end))) as time')->first();

        return $time;
    }

    /**
     * Открытие и закрытие смены
     * @param  Collaborator  $collaborator
     * @return string[]
     */
    public function workTime(Collaborator $collaborator)
    {
        $status = '';
        if ($collaborator->isOpenWorkTime()) {
            $workTime = $collaborator->WorkTime()->whereNull('end')->first();
            $workTime->end = now();
            $workTime->save();
            $status = 'close';
        } else {
            $collaborator->WorkTime()->create(['start' => now()]);
            $status = 'open';
        }

        return ['workTime' => $status];
    }
}
