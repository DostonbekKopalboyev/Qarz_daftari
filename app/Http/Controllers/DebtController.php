<?php

namespace App\Http\Controllers;

use App\Models\Costumer;
use App\Models\Debt;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;




class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $debts = Debt::paginate(20);
        $costumers = Costumer::all();
        return view('admin.debt', ['debts'=>$debts,'costumers'=>$costumers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasDirectPermission('debt.store')) {
            $request->validate([
                'costumer_id' => 'required',
                'product' => 'required',
                'quantity' => 'required',
                'end_day' => 'required'
            ]);
            $costumer=Costumer::all();
            $debt = $request->all();
            $debt['user_id'] = auth()->user()->id;
            $costumer_id = $request->costumer_id;
            $costumer = Costumer::where('id', $costumer_id)->first();
            $costumer->debt += intval($request->quantity);
//            dd(get_debug_type($debt['end_day']));
            if($debt['end_day']>=Carbon::now()){
//                dd('hello');
                $debt['end_day']=$request->end_day;
            }
            else return redirect()->back()->with('error', 'Bunday vaqtda qarzni qaytarib bo\'lmaydi');
            $costumer->save();
            Debt::create($debt);
        }
            return redirect()->back()->with('success', 'Muvaffaqqiyatli qo\'shildi');

    }

    /**
     * Display the specified resource.
     */
    public function show(Debt $debt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Debt $debt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Debt $debt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Debt $debt)
    {
        //
    }
    public function permission(User $user)
    {
        if(Auth::user()->hasDirectPermission('profile.permission')) {
            $user_permission = $user->permissions;
            $permissions = Permission::all();
            return view('admin.permissions',['user_permissions'=>$user_permission, 'user'=>$user,'permissions'=>$permissions]);
        }
    }


    public function message(){
        $today = Carbon::now()->toDateString();
        $debts = Debt::whereDate('end_day', '=', $today)
                ->get();
        $costumers = Costumer::all();
        return view('admin.message', ['debts'=>$debts,'costumers'=>$costumers]);
    }



    public function last_week()
    {

        $sevenDaysAgo = Carbon::now()->subDays(6)->toDateString();
        $debts = Debt::whereDate('end_day', '>=', $sevenDaysAgo)
            ->whereDate('end_day', '<=', Carbon::now()->toDateString())
            ->get();

        // Output or process the selected Debt records
            foreach ($debts as $debt) {
                return view('admin.last_week',['debts'=>$debts]);
                // Add other fields as needed
            }






//        $debts=Debt::all();
//        //$endDate = 1haftalik end_daylarni sanisi
//        $endDate =  date(Carbon::today()->copy()->subDays(6));
//        //$startDate bugungi kun
//        $startDate =date(Carbon::today());
//
//        //1haftalik kunlar sanalari
//        $period = (CarbonPeriod::create($endDate, $startDate)->toArray());
//
//        // 1haftalik kunlarni yil-oy-kun korinishida yozib beradi
//        foreach ($period as $date) {
//            $arr1[]= $date->toDateString() ;
//        }
////        dd(gettype($arr1[1]));
//        //1haftalik end_day lar
//        $endDays = Debt::pluck('end_day')->toArray();
////        foreach ($endDays as $item) {
////            $arr2[]=$item->toDateString();
////        }
////        dd($endDays);
//        foreach ($arr1 as $date) {
////        dd(gettype($date));
//            foreach ($endDays as $week) {
////            dd($week);
//                if ($week === $date) {
////               dd(gettype(Debt::where('end_day')));
//                    $massiv[]=Debt::whereDate($week,'end_day');
//                    dd($massiv);
////                    return view('admin.last_week',['debts'=>$massiv]);
//                }
////            echo $date->toDateString() . '<br>';
//            }
//        }
//        foreach ($massiv as $item) {
//
//        }
        return view('admin.last_week',['debts'=>$debts]);

    }


}
