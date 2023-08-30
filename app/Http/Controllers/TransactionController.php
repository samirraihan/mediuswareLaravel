<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $transactions = Transaction::where('user_id', $user->id)->get();
        return view('dashboard', compact('transactions'));
    }
    public function depositCreate()
    {
        $user = auth()->user();
        $transactions = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'deposit')
            ->get();
        return view('transactions.deposit', compact('transactions'));
    }
    public function withdrawCreate()
    {
        $user = auth()->user();
        $transactions = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'withdraw')
            ->get();
        return view('transactions.withdraw', compact('transactions'));
    }
    public function depositeStore(Request $request)
    {
        $user = auth()->user();
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $request->amount;
        $transaction->transaction_type = 'deposit';
        $transaction->date = now();
        $transaction->save();
        $user->balance = $user->balance + $request->amount;
        $user->save();
        return redirect()->route('deposit.create');
    }
    public function withdrawStore(Request $request)
    {
        $user = auth()->user();
        $totalWithdrawalAmountThisMonth = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'withdraw')
            ->where('date', 'like', date('Y-m') . '%')
            ->sum('amount');

        if ($user->account_type === 'individual') {
            if (date('l') === 'Friday') {
                $withdrawalRate = 0.00;
            } else {
                if ($totalWithdrawalAmountThisMonth < 5000) {
                    $withdrawalRate = 0.00;
                } else {
                    if ($request->amount > 1000) {
                        $withdrawalRate = 0.015;
                    } else {
                        $withdrawalRate = 0.015;
                    }
                }
            }
        } else if ($user->account_type === 'business') {
            if ($totalWithdrawalAmountThisMonth >= 50000) {
                $withdrawalRate = 0.015;
            } else {
                $withdrawalRate = 0.025;
            }
        }

        if ($request->amount > 1000 && $user->account_type === 'individual') {
            $withdrawalFee = (($request->amount - 1000) * $withdrawalRate) / 100;
            $request->amount = $request->amount + $withdrawalFee;
        } else {
            $withdrawalFee = (($request->amount * $withdrawalRate) / 100);
            $request->amount = $request->amount + $withdrawalFee;
        }

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $request->amount;
        $transaction->fee = $withdrawalFee;
        $transaction->transaction_type = 'withdraw';
        $transaction->date = now();
        $transaction->save();
        $user->balance = $user->balance - $request->amount;
        $user->save();
        return redirect()->route('withdraw.create');
    }
}
