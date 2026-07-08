<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\IncomeSource;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class IncomeController extends Controller
{
        public function income_list(Request $request){
            $month = $request->month ?? date('m');
            $year  = $request->year ?? date('Y');
            $incomes = Income::whereYear('income_date', $year)->whereMonth('income_date', $month)->get();
            return view('Admin.incomes.income_list',compact('incomes'));
        }

        public function income_add(){
            $sources = IncomeSource::all();
            return view('Admin.incomes.income_add',compact('sources'));
        }


        public function income_save(Request $request){

            $request->validate([
                'source_id'=>['required','exists:income_sources,id'],
                'income_amount'=>['required','numeric'],
                'income_date'=>['required','date'],
            ]);
            $income = new Income();
            $income->source_id = $request->source_id;
            $income->income_amount = $request->income_amount;
            $income ->income_date = $request->income_date;
            $income->save();
            return redirect()->route('income_list')->with('success','Income Added Successfully!');
        }


        public function income_edit($id){
            $income = Income::find($id);
            $sources = IncomeSource::all();
            return view('Admin.incomes.income_edit',compact('income','sources'));
        }




        public function income_update(Request $request,$id){

            $request->validate([
                'source_id'=>['required','exists:income_sources,id'],
                'income_amount'=>['required','numeric'],
                'income_date'=>['required','date'],
            ]);
            $income = Income::find($id);
            $income->source_id = $request->source_id;
            $income->income_amount = $request->income_amount;
            $income ->income_date = $request->income_date;
            $income->save();
            return redirect()->route('income_list')->with('success','Income Updated Successfully!');
        }



        public function income_delete($id){
            $income = Income::find($id);
            $income->delete();
            return redirect()->route('income_list')->with('success','Income Deleted Successfully!');
        }















        public function income_source_list(){
            $income_sources = IncomeSource::all();
            return view('Admin.incomes.income_source_list',compact('income_sources'));
        }




        public function income_source_add(){
            return view('Admin.incomes.income_source_add');
        }


        public function income_source_save(Request $request){

           $request->validate([
                'source_name'=>['required','string','max:255'],

           ]);
            $income_source = new IncomeSource();
            $income_source ->source_name = $request->source_name;
            $income_source->save();
            return redirect()->route('income_source_list')->with('success','Income Source Added Successfully!');
        }


        public function income_source_edit($id){
            $income_source = IncomeSource::find($id);
            return view('Admin.incomes.income_source_edit',compact('income_source'));
        }

        public function income_source_update(Request $request,$id){
            $request->validate([
                'source_name'=>['required','string','max:255'],
            ]);

            $income_source = IncomeSource::find($id);
            $income_source ->source_name = $request->source_name;
            $income_source->save();
            return redirect()->route('income_source_list')->with('success','Income Source Updated Successfully!');
        }



        public function income_source_delete($id){
            $income_source = IncomeSource::find($id);
            $income_source->delete();
            return redirect()->route('income_source_list')->with('success','Income Source Deleted Successfully!');
        }

}
