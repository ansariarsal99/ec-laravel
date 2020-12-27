<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\ProductCategory;
use App\ProductSubCategory;
use App\Product;

class ServiceExport implements  FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $countryList =Country::select('countries.*');
        $count = Product::with('category')
						        ->where('type','service')
						        ->where('user_id',\Auth::user()->id)
						        ->orderBy('id', 'desc')
						        ->count();
    	// dd($count - 2000);
    	$offset = 0;
    	$limit = 1000;
    	$arr_to_return = [];

    	while($count>=0){

    		$User_data = Product::with('category')
						        ->where('type','service')
						        ->where('user_id',\Auth::user()->id)
						        ->orderBy('id', 'desc')
						        ->skip($offset)
	                            ->take($limit)
	                            ->get()
	                            ->toArray();

    		foreach ($User_data as $key => $value) {
					  // dd($value);
    			$arr_to_return[] = [
                'Sr. No.'                => $key+1,
                'Service Name'           => $value['product_name'] ? ucfirst($value['product_name']) : '',
                'Category Name'          => $value['category']['name'] ? ucfirst($value['category']['name']) : '',
                'Price'  		         => $value['price_per_unit'] ? $value['price_per_unit'] : '',
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
            'Service Name',
			'Category Name',
			'price',
			'status'
        ];
    }
}
