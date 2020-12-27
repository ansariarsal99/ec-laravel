<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use App\ProductColor;
use App\ProductUnit;

class Product_Unit_Export implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function collection()
    {
         $count = ProductUnit::count();
         $offset = 0;
         $limit = 1000;
         $arr_to_return = [];

     while($count>=0){
    		$subCategoryData = ProductUnit::skip($offset)
	                            ->take($limit)
	                            ->get()
	                            ->toArray();

    		foreach ($subCategoryData as $key => $value) {
    			$arr_to_return[] = [
	                'Sr. No.'                  => $key+1,
	                'Product Unit Name'        => $value['unit'] ? ucfirst($value['unit']) : '',
                    'Status'  		           => $value['status'] ? $value['status'] : '',
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
            'Product Unit Name',
            'Status'
        ];
    }
}
