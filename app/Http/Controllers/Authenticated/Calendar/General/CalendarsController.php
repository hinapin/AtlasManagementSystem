<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request){
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            $getDate = $request->getData;
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    public function cancel(Request $request){
        DB::beginTransaction();
        try {
            // フォームから送信された予約情報を取得
            $reserveDate = $request->reserve_date;
            $reserveTime = $this->convertReserveTimeToInt($request->reserve_time);

            // dd($reserveDate, $reserveTime);


            // 予約設定の取得
            $reserve_settings = ReserveSettings::where('setting_reserve', $reserveDate)
                                ->where('setting_part', $reserveTime)
                                ->first();

            // dd($reserve_settings);

            if ($reserve_settings) {
                // 予約を削除（ログインしているユーザーの予約のみキャンセル）
                $reserve_settings->users()->detach(Auth::id());
                // キャンセルされたので、予約可能数をインクリメント
                $reserve_settings->increment('limit_users');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    // "リモ3部" のような文字列を適切な数値（例: 1, 2, 3）に変換する必要がある。
    //　"リモ3部" を 3 として扱う場合、対応する変換を行う。

    private function convertReserveTimeToInt($reserveTime) {
    // 予約時間を対応する整数に変換
    switch ($reserveTime) {
        case 'リモ1部':
            return 1;
        case 'リモ2部':
            return 2;
        case 'リモ3部':
            return 3;
    }
    }

}
