<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\UserInquery;
use auth;

class UserInqueryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
      public function collection()
        {

        $count = UserInquery::count();
      	$offset = 0;
      	$limit = 1000;
      	$arr_to_return = [];

      	while($count>=0){  

		    $userInqueries = UserInquery::where('seller_id',Auth::user()->id)
		    ->leftJoin('users','users.id','user_inqueries.user_id')
		    ->select('user_inqueries.*','users.first_name as first_name','users.last_name as last_name')
		    ->skip($offset)
            ->take($limit)
            ->get()
            ->toArray();
            // dd($userInqueries);


      		foreach ($userInqueries as $key => $value) {
      			$arr_to_return[] = [
                  'Sr. No.'           => $key+1,
                  'Date Time'        => $value['created_at'] ? ucfirst($value['created_at']) : '',
                  'User Name'         => @ucfirst($value['first_name'] . $value['last_name']) ? @ucfirst($value['first_name'] . $value['last_name']) : '',
                  'query'  		      => $value['query'] ? $value['query'] : '',
                  'Response status'   => $value['respond_status'] ? $value['respond_status'] : '',
                  'reponse'           => $value['response'] ? $value['response'] : '',
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
            'Date Time',
  			'User Name',
  			'Query',
  			'Response Status',
            'Response',
          ];          

      }
}
