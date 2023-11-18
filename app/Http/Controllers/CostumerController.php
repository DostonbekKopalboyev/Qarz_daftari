<?php

namespace App\Http\Controllers;

use App\Models\Costumer;
use App\Models\Debt;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\ProcessedCodeCoverageData;
use Spatie\Permission\Models\Permission;

class CostumerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $costumers = Costumer::paginate(20);
//      ->sortByDesc('debt');

        return view('admin.costumer')->with('costumers', $costumers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function debt_info(Request $request, Costumer $costumer)
    {
//        if(Auth::user()->hasDirectPermission('costumer.debt_info')) {
        $debts = $costumer->debts;
        $payments = $costumer->payments;
        return view('admin.debt_info', ['debts' => $debts, 'payments' => $payments]);
//        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if (Auth::user()->hasDirectPermission('costumer.store')) {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required'
            ]);
            $costumer = $request->all();
            $costumer['user_id'] = auth()->user()->id;
            Costumer::create($costumer);
        }
        return redirect()->back()->with('success', 'Muvaffaqqiyatli qo\'shildi');

    }

    /**
     * Display the specified resource.
     */
    public function show(Costumer $costumer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Costumer $costumer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Costumer $costumer): RedirectResponse
    {
        if (Auth::user()->hasDirectPermission('costumer.update')) {
            $request->validate([
                'id' => 'required',
                'name' => 'required',
                'phone' => 'required|numeric',
                'address' => 'required'
            ]);

            $costumer = Costumer::find($request->id);
            $costumer->name = $request->name;
            $costumer->phone = $request->phone;
            $costumer->address = $request->address;
            $costumer->description = $request->description;
            $costumer->save();
        }
        return redirect()->back()->with('success', 'Muvaffaqqiyatli yangilandi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth::user()->hasDirectPermission('costumer.destroy')) {
            Costumer::where('id', $id)->delete();
        }
        return redirect()->back()->with('success', 'Muvaffaqqiyatli o\'chirildi');

    }

    public function permission(User $user)
    {
        if (Auth::user()->hasDirectPermission('profile.permission')) {
            $user_permission = $user->permissions;
            $permissions = Permission::all();
            return view('admin.permissions', ['user_permissions' => $user_permission, 'user' => $user, 'permissions' => $permissions]);
        }
    }


    public function search(Request $request)
    {
        $search = $request->input('search');
        $context = $request->input('context');

        if ($context === 'costumers') {
            $costumers = Costumer::where('name', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->orWhere('address', 'LIKE', "%$search%")
                ->orWhere('description', 'LIKE', "%$search%")
                ->orWhere('debt', 'LIKE', "%$search%")
                ->get();
        } elseif ($context === 'debts') {
            $debt = Debt::join('costumers', 'debts.costumer_id', '=', 'costumers.id')
                ->join('users', 'debts.user_id', '=', 'users.id')
//                    ->join('debts', 'debts.end_day', '=', 'users.id')
                ->where('costumers.name', 'LIKE', "%$search%")
                ->orwhere('users.name', 'LIKE', "%$search%")
                ->orwhere('debts.end_day', 'LIKE', "%$search%")
                ->orwhere('debts.quantity', 'LIKE', "%$search%")
                ->orwhere('debts.product', 'LIKE', "%$search%")
                ->orwhere('debts.created_at', 'LIKE', "%$search%")
                ->select('debts.*')
                ->get();
            return view('admin.search', compact('debt', 'context'), ['debts' => $debt]);

        } elseif ($context === 'payments') {
            $payments = Payment::join('costumers', 'payments.costumer_id', '=', 'costumers.id')
                ->join('users', 'payments.user_id', '=', 'users.id')
                ->where('costumers.name', 'LIKE', "%$search%")
                ->orwhere('users.name', 'LIKE', "%$search%")
                ->orwhere('payments.quantity', 'LIKE', "%$search%")
                ->orwhere('payments.created_at', 'LIKE', "%$search%")
                ->select('payments.*')
                ->get();
            return view('admin.search', compact('payments', 'context'), ['payments' => $payments]);


        } elseif ($context === 'permissions') {
            $users = User::where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->get();
            return view('admin.search', compact('users', 'context'), ['payments' => $users]);
        } elseif ($context === 'messages') {
            $debt = Debt::whereDate('end_day', '=', Carbon::now()->toDateString())
                ->join('costumers', 'debts.costumer_id', '=', 'costumers.id')
                ->join('users', 'debts.user_id', '=', 'users.id')
                ->where('costumers.name', 'LIKE', "%$search%")
                ->orwhere('users.name', 'LIKE', "%$search%")
                ->orwhere('debts.end_day', 'LIKE', "%$search%")
                ->orwhere('debts.quantity', 'LIKE', "%$search%")
                ->orwhere('debts.product', 'LIKE', "%$search%")
                ->orwhere('debts.created_at', 'LIKE', "%$search%")
                ->select('debts.*')
                ->get();
            return view('admin.search', compact('debt', 'context'), ['debts' => $debt]);
        } elseif ($context === 'last_weeks') {
            $debt = Debt::whereDate('end_day', '>=', Carbon::now()->subDays(6)->toDateString())
                ->whereDate('end_day', '<=', Carbon::now()->toDateString())
            ->join('costumers', 'debts.costumer_id', '=', 'costumers.id')
                ->join('users', 'debts.user_id', '=', 'users.id')
                ->where('costumers.name', 'LIKE', "%$search%")
                ->orwhere('users.name', 'LIKE', "%$search%")
                ->orwhere('debts.end_day', 'LIKE', "%$search%")
                ->orwhere('debts.quantity', 'LIKE', "%$search%")
                ->orwhere('debts.product', 'LIKE', "%$search%")
                ->orwhere('debts.created_at', 'LIKE', "%$search%")
                ->select('debts.*')
                ->get();
            return view('admin.search', compact('debt', 'context'), ['debts' => $debt]);
        }


    }
}
