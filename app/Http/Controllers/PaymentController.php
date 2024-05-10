<?php

namespace App\Http\Controllers;

use App\Models\Costumer;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::paginate(20);
        $costumers = Costumer::all();
        $users = User::all();
        return view('admin.payment', ['payments' => $payments, 'costumers' => $costumers, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        if(Auth::user()->hasDirectPermission('payment.store')) {
            $request->validate([
                'costumer_id' => 'required',
                'quantity' => 'required',
            ]);

            $payment = $request->all();
            $payment['user_id'] = auth()->user()->id;
            $costumer_id = $request->costumer_id;
            $costumer = Costumer::where('id', $costumer_id)->first();
            $costumer->debt -= intval($request->quantity);
            $costumer->save();
            Payment::create($payment);
        }
        return redirect()->back()->with('success', 'Muvaffaqqiyatli qo\'shildi');
    }


    public function show(Payment $payment)
    {
        //
    }


    public function edit(Payment $payment)
    {
        //
    }


    public function update(Request $request, Payment $payment)
    {
        //
    }


    public function destroy(Payment $payment)
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
}
