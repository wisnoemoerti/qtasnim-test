<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Barang extends Model
{
    use HasFactory;

    public static function createData($request)
    {
    	DB::beginTransaction();
        try {
            $db = new Barang();
            $db->nama_barang= $request->nama_barang;
            $db->stok= $request->stok;
            $db->jumlah_terjual= $request->jumlah_terjual;
            $db->tanggal_transaksi= $request->tanggal_transaksi;
            $db->jenis_barang= $request->jenis_barang;
			$db->save();
	    	DB::commit();
			$responseData = 'Data berhasil disimpan';
			return response()->json(['message'=> $responseData, 'data' => $responseData], 201);
        } catch (\Exception $ex) {
            DB::rollback();
            $responseData = $ex->getMessage();
			return response()->json(['message'=> 'failed', 'data' => $responseData], 400);
        }
    }

	public static function updateData($request)
    {
    	DB::beginTransaction();
        try {
            $db = Barang::find($request->id);
			$db->nama_barang= $request->nama_barang;
            $db->stok= $request->stok;
            $db->jumlah_terjual= $request->jumlah_terjual;
            $db->tanggal_transaksi= $request->tanggal_transaksi;
            $db->jenis_barang= $request->jenis_barang;
			$db->save();
            DB::commit();
			$responseData = 'Data berhasil dirubah';
	    	return response()->json(['message'=> $responseData, 'data' => $responseData], 201);
        } catch (\Exception $ex) {
            DB::rollback();
            $responseData = $ex->getMessage();
			return response()->json(['message'=> 'failed', 'data' => $responseData], 400);
        }
    }

    public static function deleteData($request)
    {
    	DB::beginTransaction();
        try {
            
            $db = Barang::find($request->id);
			$db->delete();
            DB::commit();
			$responseData = 'Data berhasil dihapus';
	    	return response()->json(['message'=> $responseData, 'data' => $responseData], 201);
        } catch (\Exception $ex) {
            DB::rollback();
            $responseData = $ex->getMessage();
	    	return response()->json(['message'=> 'failed', 'data' => $responseData], 400);
        }
    }
}
