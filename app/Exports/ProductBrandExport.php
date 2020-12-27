<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\ProductBrand;

class ProductBrandExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function collection()
    {
        // dd('here');
        $count = ProductBrand::count();
    	// dd($count);
    	$offset = 0;
    	$limit = 1000;
    	$arr_to_return = [];

    	while($count>=0){

    		$subCategoryData = ProductBrand::skip($offset)
	                            ->take($limit)
	                            ->get()
	                            ->toArray();
           // dd($subCategoryData);
    		foreach ($subCategoryData as $key => $value) {
    			$arr_to_return[] = [
	                'Sr. No.'              => $key+1,
                    'Brand Name'           => $value['brand_name'] ? ucfirst($value['brand_name']) : '',
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
            'Brand Name',
            'Status'
        ];
    }
}
