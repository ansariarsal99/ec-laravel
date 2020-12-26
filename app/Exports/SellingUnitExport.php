<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use App\ProductColor;
use App\ProductSellingUnit;

class SellingUnitExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection() {

         $count = ProductSellingUnit::count();
         $offset = 0;
         $limit = 1000;
         $arr_to_return = [];

        while($count>=0){
    		$sellingUnitData = ProductSellingUnit::skip($offset)
	                            ->take($limit)
                                ->orderBy('id','desc')
	                            ->get()
	                            ->toArray();

    		foreach ($sellingUnitData as $key => $value) {
    			$arr_to_return[] = [
	                'S. No.'                   => $key+1,
	                'Selling Unit'  => $value['name'] ? ucfirst($value['name']) : '',
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
            'S. No.',
            'Selling Unit',
            'Status'
        ];
    }
}
