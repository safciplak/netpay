<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Utilities\Expense;
use App\Utilities\Payroll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class FileController extends Controller
{
    /**
     * @var Expense
     */
    private $expenses;
    /**
     * @var Payroll
     */
    private $payrolls;


    /**
     * FileController constructor.
     *
     * @param Expense $expenses
     * @param Payroll $payrolls
     */
    public function __construct(Expense $expenses, Payroll $payrolls)
    {
        $this->expenses = $expenses;
        $this->payrolls = $payrolls;
    }

    public function test()
    {
//        Expenses Date
        $expenssesDates = [];
        for ($i = 1; $i <= 12; $i++) {
            $expenssesDates[] = $this->expenses->getDate(Carbon::createFromDate(2012, $i, 1));
        }
        // Payrol Date
        $payrolDates = null;
        $dates = ['January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'];
        foreach ($dates as $date) {
            $payrolDates[] = $this->payrolls->getDate($date);
        }

        $files = File::all();
        if($files->isEmpty()){
            File::truncate();
            $this->createNestedList();
            $this->showNestedList();
        }


        return view('files');
    }

    public function search()
    {
        $search = request('search');
        $result = DB::table('files')
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        try {
            $id = $result->first() ? $result->first()->id : null;
            if ($id != null){
                $node1 = File::ancestorsAndSelf($id);
                $node2 = File::descendantsOf($id);


                $allItems = new \Illuminate\Database\Eloquent\Collection; //Create empty collection which we know has the merge() method
                $allItems = $allItems->merge($node1);
                $allItems = $allItems->merge($node2);


                $str = '';
                foreach ($allItems as $item) {
                    if (!isset($item->parent)) {
                        $main = $item;
                        $mainName = $item->name;
                    } else {
                        if ($item->parent->id == $main->id) {
                            $base = $mainName . "/" . $item->name;
                        } else {
                            $str .= $base . "/" . $item->name . "<br>";
                        }
                    }
                }
                $str = $base . "<br>" . $str;
                echo strip_tags($str, "<br>");
            } else {
                echo "No records found";
            }


        } catch (Exception $e) {
            echo $e->getMessage();
        }


//        $traverse = function ($categories, $prefix = '-') use (&$traverse) {
//            foreach ($categories as $category) {
//                echo PHP_EOL . $prefix . ' ' . $category->name . "<br>";
//
//                $traverse($category->children, $prefix . '-');
//            }
//        };
//
//        dd($traverse($nodes));

    }

    public function createNestedList():void
    {
        $node = File::create([
            'name' => 'Documents',
        ]);

        $node2 = File::create([
            'name'     => 'Images',
            'children' => [
                [
                    'name' => 'Images1.jpg',
                ],
                [
                    'name' => 'Images2.jpg',
                ],
                [
                    'name' => 'Images3.jpg',
                ],
            ],
        ]);
        $node2->appendToNode($node)->save();


        $node3 = File::create([
            'name' => 'Works',
        ]);

        $node3->appendToNode($node)->save();


        $node4 = File::create([
            'name' => ' Letter.doc',
        ]);

        $node4->appendToNode($node3)->save();


        $node5 = File::create([
            'name'     => 'Accountant',
            'children' => [
                [
                    'name' => 'Accounting.xls',
                ],
                [
                    'name' => 'AnnualReport.xls',
                ],
            ],
        ]);

        $node5->appendToNode($node3)->save();

        $node6 = File::create([
            'name' => 'Program Files',
        ]);
//
        $node7 = File::create([
            'name'     => 'Skype',
            'children' => [
                [
                    'name' => 'Skype.exe',
                ],
                [
                    'name' => 'Readme.txt',
                ],
            ],
        ]);
        $node7->appendToNode($node6)->save();


        $node8 = File::create([
            'name'     => 'Mysql',
            'children' => [
                [
                    'name' => 'Mysql.exe',
                ],
                [
                    'name' => 'Mysql.com',
                ],
            ],
        ]);

        $node8->appendToNode($node6)->save();

    }


    public function showNestedList()
    {
        $nodes = File::get()->toTree();
        $traverse = function ($categories, $prefix = '-') use (&$traverse) {
            foreach ($categories as $category) {
                echo PHP_EOL . $prefix . ' ' . $category->name . "<br>";

                $traverse($category->children, $prefix . '-');
            }
        };

        dd($traverse($nodes));
    }

    /**
     * @return string
     */
    public function getExpensesDate($date)
    {

    }
}
