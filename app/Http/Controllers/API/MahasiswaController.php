<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->input('id');
        $query = $request->input('query');
        $limit = $request->input('limit');

        if($id){
            $data = Mahasiswa::find($id)->get();

            if($data){
                return ResponseFormatter::success($data, "Sukses mengambil data mahasiswa");
            } else {
                return ResponseFormatter::error(null, "Gagal mengambil data mahasiswa", 404);
            }
        }

        $data = Mahasiswa::query();
        
        if($query){
            $data->where("nama", 'like',"%".$query."%")
            ->orWhere("nbi","like","%".$query."%");
        }

 
        return ResponseFormatter::success($data->paginate($limit), "Sukses mengambil data mahasiswa");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try{

            $data = [
                'nbi' => $request->nbi, 
                'nama' => $request->nama, 
                'telp' => $request->telp, 
                'alamat' => $request->alamat,
                'email' => $request->email,
                'tgl_lahir' => $request->tgl_lahir,
                'prodi' => $request->prodi,
                'fakultas' => $request->fakultas,
                'ipk' => $request->ipk,
                'dosen_wali' => $request->dosen_wali,
            ];

            if ($request->has('foto')) {

                $filename = time().$request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs('uploads/images',$filename);
                $data['foto'] = $path; 
            }
            
            Mahasiswa::create($data);

            

            return ResponseFormatter::success($data,
                'Berhasil Tambah Mahasiswa'
            );
        } catch (Exception $err){
            return ResponseFormatter::error(
                [
                    'message' => 'Something went wrong',
                    'error' => $err
                ],
                'Failed', 500
            );
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $data = Mahasiswa::where('id',$id)->first();
            
            $d = [
                'nbi' => $request->nbi, 
                'nama' => $request->nama, 
                'telp' => $request->telp, 
                'alamat' => $request->alamat,
                'tgl_lahir' => $request->tgl_lahir,
                'prodi' => $request->prodi,
                'fakultas' => $request->fakultas,
                'ipk' => $request->ipk,
                'dosen_wali' => $request->dosen_wali,
            ];

            if ($request->has('foto')) {
                
                $filename = time().$request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs('uploads/images',$filename);
                $d['foto'] = $path; 
            }

            $data->update($d);

            
    

            return ResponseFormatter::success($data,
                'Berhasil Update Mahasiswa'
            );
        } catch (Exception $err){
            return ResponseFormatter::error(
                [
                    'message' => 'Something went wrong',
                    'error' => $err
                ],
                'Failed', 500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $data = Mahasiswa::where('id', $id)->first();

            $data->delete();

            return ResponseFormatter::success([],
                'Berhasil Delete Mahasiswa'
            );

        } catch (Exception $err){
            return ResponseFormatter::error(
                [
                    'message' => 'Something went wrong',
                    'error' => $err
                ],
                'Failed', 500
            );
        }
    }
}
