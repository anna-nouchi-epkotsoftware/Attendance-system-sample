<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Models\Work;

class AdminWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/work/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $user,$searchYear,$searchMonth,$name
     * @return \Illuminate\Http\Response
     */
    public function show($user, $searchYear, $searchMonth, $name)
    {
        $works = DB::table('users')
            ->join('works', 'users.id', '=', 'works.user_id')
            ->whereYear('works.date', $searchYear)
            ->whereMonth('works.date', $searchMonth)
            ->where('users.id', '=', $user)
            ->orderBy('works.date', 'asc')
            ->get();
        return view('admin.work.show', [
            'works' => $works,
            'searchYear'    => $searchYear,
            'searchMonth'   => $searchMonth,
            'name'   => $name,
            'user'   => $user,
        ]);
    }


    public function search(Request $request)
    {
        $name ="%$request->name%";
        $id = $request->id;

        if ($id !== null) {
            $users = DB::table('users')
                ->select('users.id', 'users.last_name', 'users.first_name')
                ->join('works', 'users.id', '=', 'works.user_id')
                ->where('users.id', '=', $id)
                ->whereYear('works.date', $request->year)
                ->whereMonth('works.date', $request->month)
                ->groupBy('users.id')
                ->get();

            return view('admin.work.index', [
                'users' => $users,
                'searchYear'  => $request->year,
                'searchMonth' => $request->month,
            ]);
        }
        $users = DB::table('users')
            ->select('users.id', 'users.last_name', 'users.first_name')
            ->join('works', 'users.id', '=', 'works.user_id')
            ->whereYear('works.date', $request->year)
            ->whereMonth('works.date', $request->month)
            ->where(DB::raw('CONCAT(last_name, first_name)'), 'like',$name )
            ->groupBy('users.id')
            ->get();

        return view('admin.work.index', [
            'users' => $users,
            'searchYear'  => $request->year,
            'searchMonth' => $request->month,
        ]);
    }

    public function approval(Work $work, $user, $searchYear, $searchMonth, $name)
    {
        //承認処理
        $work->status_id = 3;
        $work->save();
        return redirect()->route('admin.works.show', ['user' => $user, 'searchYear' => $searchYear, 'searchMonth' => $searchMonth, 'name' => $name]);
    }

    //CSV出力機能
    public function csv($id, $searchYear, $searchMonth, $name)
    {
        $csvName = "{$id}_{$searchYear}年{$searchMonth}月{$name}.csv";

        //   CSVレコード配列取得
        $csvRecords = self::getJobCsvRecords($id, $searchYear, $searchMonth);

        //   CSVストリームダウンロード
        return self::streamDownloadCsv($csvName, $csvRecords);
    }

    //データベースから配列出力
    private static function getJobCsvRecords($id, $searchYear, $searchMonth): array
    {
        //条件に合うデータ取得
        $works = Work::where('user_id', '=', $id)
            ->whereYear('date', $searchYear)
            ->whereMonth('date', $searchMonth)
            ->orderBy('date', 'asc')
            ->get();

        $csvRecords = [
            ['日付', '始業時間', '退勤時間', '休憩時間', '備考', '総務コメント'], // ヘッダー
        ];
        foreach ($works as $work) {
            $csvRecords[] = [$work->date, $work->work_start_time, $work->work_end_time, $work->break_time, $work->work_content, $work->comment]; // レコード
        }
        return $csvRecords;
    }

    //CSV出力
    private static function streamDownloadCsv(
        string $name,
        iterable $fieldsList,
        string $separator = ',',
        string $enclosure = '"',
        string $escape = "\\",
        string $eol = "\r\n"
    ) {
        // Content-Type
        $contentType = 'text/plain'; // テキストファイル

        //csvとtsvに分けている
        if ($separator === ',') {
            $contentType = 'text/csv'; // CSVファイル
        } elseif ($separator === "\t") {
            $contentType = 'text/tab-separated-values'; // TSVファイル
        }

        //レスポンスヘッダ用情報を変数に入れてる
        $headers = ['Content-Type' => $contentType];

        return response()->streamDownload(
                function () use ($fieldsList, $separator, $enclosure, $escape, $eol) {
                    $stream = fopen('php://output', 'w');

                    foreach ($fieldsList as $fields) {
                        fputcsv($stream, $fields, $separator, $enclosure, $escape, $eol);
                    }
                    fclose($stream);
                },
                $name,
                $headers
            ); //(出力するtextファイル作ってる,csvファイル名,ヘッダ情報)
    }
}
