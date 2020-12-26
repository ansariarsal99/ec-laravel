<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\ProductSubCategory;

class ProductSubCategoryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $count = ProductSubCategory::count();
    	// dd($count);
    	$offset = 0;
    	$limit = 1000;
    	$arr_to_return = [];

    	while($count>=0){

    		$subCategoryData = ProductSubCategory::with('category')
    							->skip($offset)
	                            ->take($limit)
	                            ->get()
	                            ->toArray();

    		foreach ($subCategoryData as $key => $value) {
    			$arr_to_return[] = [
	                'Sr. No.'              => $key+1,
	                'Category Name'		   => $value['category']['name'],
	                'Name'                 => $value['name'] ? ucfirst($value['name']) : '',
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
            'Category Name',
            'Name',
            'Status'
        ];
    }
}
