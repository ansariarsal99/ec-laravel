<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use App\ProductColor;
use App\RewardPoint;
use App\ProductCategory;
use App\Product;

class ProductRewardExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
       {
            $count = RewardPoint::count();
            $offset = 0;
            $limit = 1000;
            $arr_to_return = [];

        while($count>=0){
       		$subCategoryData =RewardPoint::where('reward_type','product')
                                        ->select('reward_points.*')
	       		                     ->skip($offset)
	   	                             ->take($limit)
	   	                             ->get()
	   	                             ->toArray();

       		foreach ($subCategoryData as $key => $value) {
       			$arr_to_return[] = [
   	               'Sr. No.'                  => $key+1,
                   // 'Reward Type'  		      => $value['reward_type'] ? $value['reward_type'] : '',
                   'Product Name'  		      => $value['product_name'] ? ucfirst($value['product_name']) : '',
                   'Point'  		          => $value['point'] ? $value['point'] : '',
                   'Status'  		          => $value['status'] ? $value['status'] : '',


                   ];
       		}
               $offset = $offset + $limit;
               $count = $count - $limit; 
               // dd($arr_to_return);
           }

           return collect($arr_to_return);
       }

      public function headings(): array
       {
           return [
               'Sr. No.',
               // 'Reward Type',
               'Product Name',
               'Point',
               'Status'
           ];
       }
}
