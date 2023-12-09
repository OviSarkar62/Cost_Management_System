<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    // User Dashboard Page
    public function index()
    {
        $totalIncomes = Income::where('user_id', auth()->user()->id)->sum('amount');
        $totalExpenses = Expense::where('user_id', auth()->user()->id)->sum('amount');
        $totalIncomeCount = Income::where('user_id', auth()->user()->id)->count();
        $totalExpenseCount = Expense::where('user_id', auth()->user()->id)->count();
        $totalTransactionCount = Income::where('user_id', auth()->user()->id)->count() + Expense::where('user_id', auth()->user()->id)->count();
        $remainingAmount = $totalIncomes - $totalExpenses;
        if (Auth::check()) {
            return view('user.user-dashboard', compact('totalIncomes', 'totalExpenses', 'totalTransactionCount', 'remainingAmount','totalIncomeCount','totalExpenseCount'));
        } else {
            return redirect()->route('login');
        }
    }
}
