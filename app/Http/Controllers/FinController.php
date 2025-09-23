<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fin;
use App\Models\Budget;

class FinController extends Controller
{
     public function index(Request $request)
    {
        $query = Fin::query();
        $budget=Budget::first();
        
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('from')) {
            $query->whereDate('date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('date', '<=', $request->to);
        }

        $fins = $query->orderBy('date','desc')->get();

        $income=0;
        $expense=0;
        foreach($fins as $fin)
            {
                if($fin->type=='income')
                {
                    $income+=$fin->amount;
                }

                elseif($fin->type=='expense')
                {
                    $expense+=$fin->amount;
                }
            }    
           
        return view('fins', compact('fins','budget','income','expense'));
    }

    public function store(Request $request)
    {
      $budget=Budget::first();
        $balance=$budget->budget;

        $request->validate([
            'type' => 'required|in:income,expense',
            'reason' => 'required|string|max:255',
            'party' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);
       $fin= Fin::create($request->all());
        if($fin->type=='income')
                {
                    $budget->budget+=$fin->amount;
                }

                elseif($fin->type=='expense')
                {
                    $budget->budget-=$fin->amount;
                }
                $budget->save();
        
        return redirect()->route('fins.index')->with('success','تمت إضافة الحركة بنجاح');

    }

      public function update(Request $request ,Fin $fin)
    {
         $budget=Budget::first();
        $balance=$budget->budget;

        $request->validate([
            'type' => 'required|in:income,expense',
            'reason' => 'required|string|max:255',
            'party' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);
       $oldAmount = $fin->getOriginal('amount');
$oldType = $fin->getOriginal('type');

$fin->update($request->all());

if ($oldType == 'income') {
    $budget->budget -= $oldAmount;
} elseif ($oldType == 'expense') {
    $budget->budget += $oldAmount;
}

if ($fin->type == 'income') {
    $budget->budget += $fin->amount;
} elseif ($fin->type == 'expense') {
    $budget->budget -= $fin->amount;
}

$budget->save();

        return redirect()->route('fins.index')->with('success','تمت تعديل الحركة بنجاح');

    }


    public function destroy(Fin $fin)
    {
        $budget = Budget::first();

        if ($fin->type == 'income') {
           $budget->budget -= $fin->amount;
            } elseif ($fin->type == 'expense') {
            $budget->budget += $fin->amount;
            }

        $budget->save();
        $fin->delete();
        return redirect()->route('fins.index')->with('success','تم حذف الحركة بنجاح');

    }

     public function update_budget(Request $request)
    {
        $request->validate([
            'budget' => 'required|numeric|min:0',
        ]);

        $budget = Budget::first(); 
        $budget->budget = $request->budget;
        $budget->save();

        return redirect()->back()->with('success', 'تم تعديل الميزانية بنجاح');
    }


}
