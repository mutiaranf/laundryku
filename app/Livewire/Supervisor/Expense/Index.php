<?php

namespace App\Livewire\Supervisor\Expense;

use Carbon\Carbon;
use App\Models\Expense;
use Livewire\Component;
use App\Models\Employee;
use App\Models\CashBalance;
use App\Models\Transaction;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $outletId;
    public function __construct()
    {

        $employeeId = auth()->user()->employee_id;
        $this->outletId = Employee::where('id', $employeeId)->first()->id;
    }
    public function render()
    {
        $expenses = Expense::where('outlet_id', $this->outletId)->latest()->paginate(5);
        return view('livewire.supervisor.expense.index', compact('expenses'));
    }

    public $name;
    public $amount;
    public $expense_date;
    public $description;

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'amount' => 'required',
            'expense_date' => 'required',
            'description' => 'required',
        ]);

        $expense = new Expense();
        $expense->name = $this->name;
        $expense->amount = $this->amount;
        $expense->description = $this->description;
        $expense->expense_date = $this->expense_date;
        $expense->outlet_id = $this->outletId;
        $expense->save();

        $cashBalance = CashBalance::where('outlet_id', $this->outletId)->first();
        $cashBalance->amount -= $this->amount;
        $cashBalance->balance_date = $this->expense_date;
        $cashBalance->save();

        $transaction = new Transaction();
        $transaction->transaction_type = 'Expense';
        $transaction->amount = $this->amount;
        $transaction->transaction_date = $this->expense_date;
        $transaction->description = $this->description;
        $transaction->outlet_id = $this->outletId;
        $transaction->save();

        $this->dispatch('success', [
            'message' => 'Expense Added Successfully'
        ]);

    }

    public function destroy($id)
    {
        $expense = Expense::find($id);

        $cashBalance = CashBalance::where('outlet_id', $this->outletId)->first();
        $cashBalance->amount += $expense->amount;
        $cashBalance->balance_date = Carbon::now();
        $cashBalance->save();
        $expense->delete();

        $this->dispatch('success', [
            'message' => 'Expense Deleted Successfully'
        ]);
    }

    public function resetForm()
    {
        $this-> reset(['name', 'amount', 'expense_date', 'description']);
    }


}
