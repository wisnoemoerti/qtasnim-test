<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;

use App\Models\Barang;
use Carbon\Carbon;
class BarangController extends Controller
{

    public function index()
    {
        return view('pages.barang');
    }
    public function datatables(Request $request)
    {
        $table = DB::table('barangs')->orderBy('created_at','desc');
        
        if($request->nama_barang){
            $table->where('barangs.nama_barang', 'like', '%'.$request->nama_barang.'%');
        }
        if($request->end_date){
            $end = Carbon::parse($request->end_date);
            $table->where('tanggal_transaksi','<=',$end);
        }
        if($request->start_date){
            $start = Carbon::parse($request->start_date);
            $table->where('tanggal_transaksi','>=',$start);
        }
            
        $datatable = Datatables::of($table->get());
        $datatable->addIndexColumn();
        $datatable->addColumn('actions', function($value) {
            $template = '
            <a href="javascript:void(0);" class="btn btn-info btn-icon-split mr-2" id="update" 
            data-id="'.$value->id.'"
            data-name="'.$value->nama_barang.'"
            data-stok="'.$value->stok.'"
            data-jumlah="'.$value->jumlah_terjual.'"
            data-tanggal="'.$value->tanggal_transaksi.'"
            data-jenis="'.$value->jenis_barang.'"
            >
                <span class="icon text-white-50">
                    <i class="fas fa-pen fa-sm"></i>
                </span>
                <span class="text">Update</span>
            </a>
            <a href="javascript:void(0);" class="btn btn-danger btn-icon-split" id="delete" data-id="'.$value->id.'">
                <span class="icon text-white-50">
                    <i class="fas fa-trash fa-sm"></i>
                </span>
                <span class="text">Delete</span>
            </a>
            ';
            return $template;
            });
            $datatable->editColumn('tanggal_transaksi', function($value) {
                return  Carbon::parse($value->tanggal_transaksi)->format('d M Y');
            });
            
        $datatable->rawColumns(['actions']);
        return $datatable->make(true);
    } 

    public function crud(Request $request){
        if ($request->isMethod('post')) {
            if($request->id !== null) {
                return Barang::updateData($request);
            }else {
                return Barang::createData($request);    
            }
        }
        else if ($request->isMethod('delete')) {
            return Barang::deleteData($request);
        }
    }

}
