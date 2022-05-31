<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithHeadings;

// class UserDetailExports implements FromCollection, WithHeadings
class UserDetailExports implements FromView, ShouldAutoSize
{
    protected $value = '';
    public function __construct($val)
    {
    	$this->value = $val;
    }

    public function view(): View
    {
    	$users_detail = User::with('users_detail');
    	if($this->value == 2 || $this->value == 0)
    	$users_detail = $users_detail->where('type','=',$this->value);
    	if($this->value == 10)
    	$users_detail = $users_detail->where('type','!=',1);
    	$users_detail = $users_detail->get();
        return view('pages.users.export_to_excel',compact('users_detail'));
    }

    // public function headings(): array
    // {
    //     return [
    //         'Name',
    //         'Surname',
    //         'Email',
    //         'Twitter',
    //     ];
    // }
}
