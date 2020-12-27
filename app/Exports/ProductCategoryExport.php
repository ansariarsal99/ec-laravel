<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\ProductCategory;

class ProductCategoryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $count = ProductCategory::count();
    	// dd($count);
    	$offset = 0;
    	$limit = 1000;
    	$arr_to_return = [];

    	while($count>=0){

    		$User_data = ProductCategory::skip($offset)
	                            ->take($limit)
	                            ->get()
	                            ->toArray();

    		foreach ($User_data as $key => $value) {
    			$arr_to_return[] = [
	                'Sr. No.'              => $key+1,
	                'Name'                 => $value['name'] ? ucfirst($value['name']) : '',
	                'Description'		   => $value['description'] ? ucfirst($value['description']) : '',
	                'Status'  		       => $value['status'] ? $value['status'] : '',
                ];
    		}
    		$offset = $offset + $limit;
    		$count = $count - $limit; 
    		// dd($arr_to_return);
    	}
    	// dd($arr_to_return);

        return collect($arr_to_return);
    }

    public function headings(): array
    {
        return [
            'Sr. No.',
            'Name',
            'Description',
            'Status'
        ];
    }
}
