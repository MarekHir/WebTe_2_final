<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authorizate;
use App\Models\Instructions;
use App\Models\User;
use App\Services\ExportToCsvService;
use App\Services\PdfGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class ExportsController extends Controller
{
    public function pdf(Instructions $instruction)
    {
        $this->authorize('generate', [Instructions::class, $instruction]);

        $service = new PdfGeneratorService();
        $service->run(Instructions::where('id', '=', $instruction->id)->with('created_by')->first(),
        User::where('id', '=', $instruction->created_by)->first());
    }

    public function csv(Request $request)
    {
        $this->authorize('export', User::class);

        $data = QueryBuilder::for(User::class)
            ->select(['users.id', 'users.first_name','users.surname', 'users.email',
                DB::raw('(SELECT COUNT(*) FROM exercises WHERE users.id = exercises.created_by) AS num_of_exercises'),
                DB::raw('(SELECT COALESCE(SUM(points), 0) FROM exercises WHERE users.id = exercises.created_by) AS total_points'),
                DB::raw('(SELECT COUNT(*) FROM exercises WHERE users.id = exercises.created_by AND exercises.solved = true) AS num_of_solved')])
            ->allowedSorts(['id', 'first_name', 'surname', 'num_of_exercises', 'total_points', 'num_of_solved'])
            ->where('role', 'student')
            ->get();

        $headers = [
            ['trans_key' => 'user.id', 'key' => 'id'],
            ['trans_key' => 'user.first_name', 'key' => 'first_name'],
            ['trans_key' => 'user.surname', 'key' => 'surname'],
            ['trans_key' => 'user.email', 'key' => 'email'],
            ['trans_key' => 'user.num_of_exercises', 'key' => 'num_of_exercises'],
            ['trans_key' => 'user.num_of_solved', 'key' => 'num_of_solved'],
            ['trans_key' => 'user.total_points', 'key' => 'total_points'],
        ];

        $service = new ExportToCsvService();
        $file = $service->run($data, $headers);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=Students export.csv',
        ];

        return response(stream_get_contents($file), 200, $headers);
    }
}
