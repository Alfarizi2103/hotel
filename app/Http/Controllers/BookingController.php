<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Bukti;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        return view('bookings.index', compact('rooms'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'nama_pemesan' => 'required',
            'email' => 'required',
            'no_hp' => 'required|max:20',
            'nama_tamu' => 'required',
            'tipe_kamar' => 'required',
            'jumlah' =>'required',
            'tgl_check_in' => 'required',
            'tgl_check_out' => 'required'
        ]);

        Booking::create($validate);
        Bukti::create([
            'nama_pemesan' => $validate['nama_pemesan'],
            'email' => $validate['email'],
            'no_hp' => $validate['no_hp'],
            'nama_tamu' => $validate['nama_tamu'],
            'tipe_kamar' => $validate['tipe_kamar'],
            'jumlah' => $validate['jumlah'],
            'tgl_check_in' => $validate['tgl_check_in'],
            'tgl_check_out' => $validate['tgl_check_out']
        ]);
        Reservation::create([
            'nama_tamu' => $validate['nama_tamu'],
            'tgl_check_in' => $validate['tgl_check_in'],
            'tgl_check_out' => $validate['tgl_check_out']
        ]);

        return redirect()->route('bukti.index');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboards.receptionist.edit',compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'nama_tamu' => 'required',
            'tgl_check_in' => 'required',
            'tgl_check_out' => 'required',
            'status'=> 'required'
        ]);

        $reservation->update($request);
        return redirect()->route('dashboards.receptionist.index')
                         ->with('success', 'Data berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
