<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Exception;
use Illuminate\Http\Request;

class DosenController extends Controller
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
            $data = Dosen::find($id)->get();

            if($data){
                return ResponseFormatter::success($data, "Sukses mengambil data dosen");
            } else {
                return ResponseFormatter::error(null, "Gagal mengambil data dosen", 404);
            }
        }

        $data = Dosen::query();
        
        if($query){
            $data->where("nama", 'like',"%".$query."%")
            ->orWhere("kode_dosen","like","%".$query."%");
        }

 
        return ResponseFormatter::success($data->paginate($limit), "Sukses mengambil data dosen");
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
        $data = [
            'kode_dosen' => $request->kode_dosen, 
            'nama' => $request->nama, 
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telp' => $request->telp,
            'tgl_lahir' => $request->tgl_lahir,
            'prodi' => $request->prodi,
            'fakultas' => $request->fakultas,
        ];

        if ($request->has('foto')) {

            $filename = time().$request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs('uploads/images',$filename);
            $data['foto'] = $path; 
        }

        try{
            
            Dosen::create($data);

            return ResponseFormatter::success($data,
                'Berhasil Tambah Dosen'
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
            $data = Dosen::where('id',$id)->first();
            
            $d = [
                'kode_dosen' => $request->kode_dosen, 
                'nama' => $request->nama, 
                'alamat' => $request->alamat,
                'email' => $request->email,
                'telp' => $request->telp,
                'tgl_lahir' => $request->tgl_lahir,
                'prodi' => $request->prodi,
                'fakultas' => $request->fakultas,   
            ];

            if ($request->has('foto')) {

                $filename = time().$request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs('uploads/images',$filename);
                $d['foto'] = $path; 
            }

            $data->update($d);

            
                

            return ResponseFormatter::success($data,
                'Berhasil Update Dosen'
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
            $data = Dosen::where('id', $id)->first();

            $data->delete();

            return ResponseFormatter::success($data,
                'Berhasil Delete Dosen'
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
