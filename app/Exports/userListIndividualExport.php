<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\User;

class userListIndividualExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function collection()
    {
        // $countryList =Country::select('countries.*');
        $count = User::count();
    	// dd($count - 2000);
    	$offset = 0;
    	$limit = 1000;
    	$arr_to_return = [];

    	while($count>=0){

    		$User_data = User::leftjoin('user_types','users.user_type_id','user_types.id')
                             ->select('users.*','user_types.name as user_type_name')
                             ->with('userTypeDetail')
                             ->where('complete_profile','yes')
                             ->where('user_type_id',1)
                             ->skip($offset)
	                         ->take($limit)
	                         ->get()
	                         ->toArray();

    		foreach ($User_data as $key => $value) {
    			$arr_to_return[] = [
                'Sr. No.'           => $key+1,
                'User Type'         => $value['user_type_name'] ? ucfirst($value['user_type_name']) : '',
                'Company Name'      => $value['company_name'] ? ucfirst($value['company_name']) : '',
                'Contact Name'      => $value['contact_name'] ? ucfirst($value['contact_name']) : '',
                'email'  		    => $value['email'] ? $value['email'] : '',
                'Subscription Title'=> $value['title'] ? $value['title'] : '',
                'Price'             => $value['price'] ? $value['price'] : '',
                'Payment Type'       => $value['payment_type'] ? $value['payment_type'] : '',
             

                        ];
   		}
    		$offset = $offset + $limit;
    		$count = $count - $limit; 
    	}

        return collect($arr_to_return);
    }

    public function headings(): array
    {
        return [
            'Sr. No.',
            'User Type',
			'Company Name',
			'Contact Name',
			'Email',
			'Subscription Title',
            'Price',
            'Payment Type',
        ];        

    }
}
