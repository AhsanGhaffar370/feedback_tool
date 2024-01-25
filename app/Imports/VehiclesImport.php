<?php

namespace App\Imports;

use App\Models\CarDetail;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class VehiclesImport implements ToModel, SkipsEmptyRows, SkipsOnError, SkipsOnFailure, WithHeadingRow, WithValidation, WithProgressBar
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $car_detail = CarDetail::where('make', $row['make'])
      ->where('model', $row['model'])
      ->where('year', $row['year'])
      ->first();
      if($car_detail == null) {
        return new CarDetail([
            'make'     => $row['make'],
            'model'    => $row['model'], 
            'year'    => $row['year'], 
            'created_at'    => Carbon::now(), 
        ]);
      }
      else {
        return null;
      }
    }

    public function rules(): array
    {
        return [
            'make' => [
                'required',
            ],
            'model' => [
                'required',
            ],
            'year' => [
                'required',
            ],
        ];
    }
}
