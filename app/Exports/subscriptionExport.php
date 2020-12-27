<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Subscription;

class subscriptionExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function collection()
    {
        // $countryList =Country::select('countries.*');
        $count = Subscription::count();
    	// dd($count - 2000);
    	$offset = 0;
    	$limit = 1000;
    	$arr_to_return = [];

    	while($count>=0){

    		$User_data = Subscription::skip($offset)
	                            ->take($limit)
	                            ->get()
	                            ->toArray();

    		foreach ($User_data as $key => $value) {
    			$arr_to_return[] = [
                'Sr. No.'                => $key+1,
                'Title'                  => $value['title'] ? ucfirst($value['title']) : '',
                'Description'            => $value['description'] ? ucfirst($value['description']) : '',
                'Time Limit'  		     => $value['time_limit'] ? $value['time_limit'] : '',
                'Time Type'  		     => $value['time_type'] ? $value['time_type'] : '',
                'Price'  		         => $value['price'] ? $value['price'] : '',
                'Status'  		         => $value['status'] ? $value['status'] : '',
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
            'title',
			'description',
			'time_limit',
			'time_type',
			'price',
			'status'
        ];
    }
}
