<?php
   
namespace App\Http\Controllers\PlaniladeControle;

use App\Models\TabelaImportExcel;
use App\Exports\criaExcelPlanilhadeControle;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Classes\Ldap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;




class DownloadexcelController extends Controller
{
public function criaPlanilhaControleExcel()
    {

        return Excel::download(new criaExcelPlanilhadeControle, 'PlanilhadeControle.xlsx');
    }

}