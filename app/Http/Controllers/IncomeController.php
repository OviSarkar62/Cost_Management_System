<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IncomeController extends Controller
{
        // Add Income Page
        public function createIncome()
        {
            if (Auth::check()) {
                return view('income.create-income');
            } else {
                return redirect()->route('login'); // Redirect to the login page
            }
        }

        // Store Income Page

        public function storeIncome(Request $request)
        {
            // Validation of input data
            $this->validate($request, [
                'title' => 'required',
                'description' => 'required',
                'date' => 'date|nullable',
                'amount' => 'required',
            ]);

            // Create a new todo
            $income = new Income;
            $income->title = $request->input('title');
            $income->description = $request->input('description');
            $income->date = $request->input('date');
            $income->amount = $request->input('amount');
            $income->user_id = auth()->user()->id; // Assign the currently authenticated user's ID

            $income->save();

            return redirect('/dashboard')->with('success', 'Income created successfully.');
        }

        // Add Income List
        public function incomeList()
        {
            if (Auth::check()) {
                $incomes = Income::where('user_id', auth()->user()->id)->get();
                return view('income.index-income', compact('incomes'));
            } else {
                return redirect()->route('login'); // Redirect to the login page
            }
        }

        public function editIncome($id)
        {
            $income = Income::where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();

            return view('income.edit-income', compact('income'));
        }

        public function updateIncome(Request $request, $id)
        {
            $income = Income::where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();

            $this->validate($request, [
                'title' => 'required',
                'description' => 'required',
                'date' => 'date|nullable',
                'amount' => 'required',
            ]);

            $income->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'date' => $request->input('date'),
                'amount' => $request->input('amount'),
            ]);

            return redirect()->route('list.income')->with('success', 'Income updated successfully.');
        }

        public function destroyIncome($id)
        {
            $income = Income::where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();

            $income->delete();
            return redirect()->route('list.income')->with('success', 'Income deleted successfully.');
        }
}
