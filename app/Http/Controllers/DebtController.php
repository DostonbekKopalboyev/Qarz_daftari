<?php

namespace App\Http\Controllers;

use App\Models\Costumer;
use App\Models\Debt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
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

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        if ($request->end_day >= Carbon::now()->format('Y-m-d')) {
            $debt = $request->all();
            $debt['user_id'] = auth()->user()->id;
            $costumer_id = $request->costumer_id;
            $costumer = Costumer::where('id', $costumer_id)->first();
            $costumer->debt += intval($request->quantity);
            $costumer->save();
            Debt::create([
                'costumer_id' => $request->costumer_id,
                'user_id' => auth()->user()->id,
                'product' => $request->product,
                'quantity' => $request->quantity,
                'end_day' => $request->end_day,
                'status' => 0,
            ]);
            return redirect()->back()->with('success', 'Muvaffaqiyatli qo\'shildi');
        } else {
            return redirect()->back()->with('error', 'Bunday vaqtda qarzni qaytarib bo\'lmaydi');
        }
    }


    public function show(Debt $debt)
    {
        //
    }


    public function edit(Debt $debt)
    {
        //
    }


    public function update(Request $request, Debt $debt)
    {
        //
    }


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
        $debts = Debt::whereDate('end_day', '>=', $sevenDaysAgo)->whereDate('end_day', '<=', Carbon::now()->toDateString())->get();
        foreach ($debts as $debt) {
            return view('admin.last_week',['debts'=>$debts]);
        }
        return view('admin.last_week',['debts'=>$debts]);
    }


}
