<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Carbon\Carbon;
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

        public function searchIncome(Request $request)
        {
            if (Auth::check()) {
                $query = $request->input('search');

                // Perform the search and retrieve matching income records
                $incomes = Income::where('user_id', auth()->user()->id)
                    ->where(function ($q) use ($query) {
                        $q->where('title', 'like', '%' . $query . '%')
                            ->orWhere('description', 'like', '%' . $query . '%')
                            ->orWhere('amount', 'like', '%' . $query . '%');
                    })
                    ->get();

                // Pass the search results to the view
                return view('income.index-income', compact('incomes'));
            } else {
                // Redirect to the login page if the user is not authenticated
                return redirect()->route('login');
            }
        }

        public function filterIncome(Request $request)
        {
            if (Auth::check()) {
                $filter = $request->input('filter');

                // Check if the selected filter is 'all' or not set
                if ($filter == 'all' || !$filter) {
                    // Get all income records without a time filter
                    $incomes = Income::where('user_id', auth()->user()->id)->get();
                } else {
                    // Get the current date
                    $currentDate = Carbon::now();

                    // Set the start date based on the selected filter
                    switch ($filter) {
                        case 'this_week':
                            $startDate = $currentDate->startOfWeek();
                            break;
                        case 'this_month':
                            $startDate = $currentDate->startOfMonth();
                            break;
                        case 'last_2_months':
                            $startDate = $currentDate->subMonths(2)->startOfMonth();
                            break;
                        case 'last_3_months':
                            $startDate = $currentDate->subMonths(3)->startOfMonth();
                            break;
                        case 'last_6_months':
                            $startDate = $currentDate->subMonths(6)->startOfMonth();
                            break;
                        case 'last_year':
                            $startDate = $currentDate->subYear()->startOfYear();
                            break;
                        default:
                            $startDate = $currentDate->startOfWeek();
                            break;
                    }

                    // Get income records within the specified time interval
                    $incomes = Income::where('user_id', auth()->user()->id)
                        ->where('date', '>=', $startDate)
                        ->get();
                }

                // Pass the filtered results to the view
                return view('income.index-income', compact('incomes'));
            } else {
                // Redirect to the login page if the user is not authenticated
                return redirect()->route('login');
            }
        }

}
