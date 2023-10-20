<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    // Add Expense Page
    public function createExpense()
    {
        if (Auth::check()) {
            return view('expense.create-expense');
        } else {
            return redirect()->route('login'); // Redirect to the login page
        }
    }

    // Store Expense
    public function storeExpense(Request $request)
    {
        // Validation of input data
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'date' => 'date|nullable',
            'amount' => 'required',
        ]);

        // Create a new expense
        $expense = new Expense;
        $expense->title = $request->input('title');
        $expense->description = $request->input('description');
        $expense->date = $request->input('date');
        $expense->amount = $request->input('amount');
        $expense->user_id = auth()->user()->id; // Assign the currently authenticated user's ID

        $expense->save();

        return redirect('/dashboard')->with('success', 'Expense created successfully.');
    }

    // Expense List
    public function expenseList()
    {
        if (Auth::check()) {
            $expenses = Expense::where('user_id', auth()->user()->id)->get();
            return view('expense.index-expense', compact('expenses'));
        } else {
            return redirect()->route('login'); // Redirect to the login page
        }
    }

    // Edit Expense
    public function editExpense($id)
    {
        $expense = Expense::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        return view('expense.edit-expense', compact('expense'));
    }

    // Update Expense
    public function updateExpense(Request $request, $id)
    {
        $expense = Expense::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'date' => 'date|nullable',
            'amount' => 'required',
        ]);

        $expense->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'amount' => $request->input('amount'),
        ]);

        return redirect()->route('list.expense')->with('success', 'Expense updated successfully.');
    }

    // Delete Expense
    public function destroyExpense($id)
    {
        $expense = Expense::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        $expense->delete();
        return redirect()->route('list.expense')->with('success', 'Expense deleted successfully.');
    }
}
