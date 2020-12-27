<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use App\ProductColor;
use App\RewardPoint;
use App\ProductCategory;
use App\Product;


class CategoryRewardExport implements FromCollection, WithHeadings
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
           		$subCategoryData =RewardPoint::where('reward_type','category')
                                      ->leftjoin('product_categories','reward_points.category_id','product_categories.id')
                                      ->select('reward_points.*','product_categories.name as category_name')
    	       		                     ->skip($offset)
    	   	                             ->take($limit)
    	   	                             ->get()
    	   	                             ->toArray();

           		foreach ($subCategoryData as $key => $value) {
           			$arr_to_return[] = [
       	               'Sr. No.'           => $key+1,
                       'Reward Type'  	   => $value['reward_type'] ? $value['reward_type'] : '',
                       'Category Name'	   => $value['category_name'] ? ucfirst($value['category_name']) : '',
                       'Point'  		   => $value['point'] ? $value['point'] : '',
                       'Status'  		   => $value['status'] ? $value['status'] : '',


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
                   'Reward Type',
                   'Category Name',
                   'Point',
                   'Status'
               ];
           }
}
