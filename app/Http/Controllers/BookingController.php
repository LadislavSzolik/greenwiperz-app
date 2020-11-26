<?php

namespace App\Http\Controllers;

use Exception;
use App\Datatrans;
use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Events\BookingCanceled;
use App\Events\BookingCompleted;
use App\Models\Appointment;
use App\TimeslotService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;

class BookingController extends Controller
{
    public function __construct()
    {
       $this->authorizeResource(Booking::class, 'booking');
    }

    public function create()
    {        
        return view('bookings.create');
    }

    public function show(Booking $booking)
    {     
        return view('bookings.show', ['booking' => $booking] );
    }


    public function cancel(Request $request, Booking $booking) 
    {  
               
        $booking->appointment->canceled_at = now();
        $booking->appointment->canceled_by = auth()->user()->id;
        $booking->appointment->save();
        $booking->status = 'canceled';
        $booking->save();
       
        $refundableAmount = $booking->refundableAmount;
        if(auth()->user()->isGreenwiper() && filled($request['amountToRefund'])) {
            if($request['amountToRefund'] > $booking->brutto_total_amount) {
                $refundableAmount = $booking->brutto_total_amount;
            }else {
                $refundableAmount = $request['amountToRefund'];
            }           
            
        }       
        Datatrans::handleBookingRefund($booking, $refundableAmount);
        event(new BookingCanceled($booking));
        $request->session()->flash('message',
        [
            'color'=>'green',
            'title'=>'Booking canceled', 
            'description'=>'Your booking was canceled. About refunds see for refunds document for details. Shortly you will receive a mail about the confirmation.'
        ]);
        return back();
    }

    public function complete(Request $request, Booking $booking)
    {
        $booking->appointment->completed_at = now();
        $booking->appointment->completed_by = auth()->user()->id;
        $booking->status = 'completed';
        $booking->save();

        event(new BookingCompleted($booking));

        $request->session()->flash('message',
        [
            'color'=>'green',
            'title'=>'Booking completed', 
            'description'=>'Nice delivery. The client will receive a confirmation mail soon!'
        ]);
        return back();
    }


    public function store(Request $request) 
    {                 
        $validated = $this->validateRequest(); 
        $availableSlots = TimeslotService::fetchSlots($validated['bookingDate'], $validated['assignedTo'],$validated['duration']); 
       
        if(!$availableSlots->contains($validated['bookingTime']))
        {                
            session()->flash('message', 'Unfortunately in a meanwhile the timeslot has been taken. Please select a new one.');
            return back();
        }
       
        $appointment = Appointment::create
        ([
            'date' => $validated['bookingDate'],
            'start_time' => $validated['bookingTime'],
            'end_time' => Carbon::parse($validated['bookingTime'])->addMinutes($validated['duration'] - 1)->format('H:i'),
            'assigned_to' => $validated['assignedTo'],
        ]);

        $user = auth()->user();
        $booking = Booking::create
        ([
            'booking_nr' => 'GW'.$this->generateBaseNumber(),
            'invoice_nr' => 'INV'.$this->generateBaseNumber(),  
            'appointment_id' => $appointment->id,          
            'status' => 'draft',
            'customer_id' => $user->id,
            'booking_datetime' =>  new Carbon($validated['bookingDate'] .' '.$validated['bookingTime']) ,
            
            'assigned_to' =>  $validated['assignedTo'] ,    
                                     
            'loc_street_number' => $validated['locStreetNumber'],
            'loc_route' =>  $validated['locRoute'] ,
            'loc_city' =>  $validated['locCity']  ,
            'loc_postal_code'  => $validated['locPostalCode'],

            'service_type' => $validated['serviceType'],
            'duration' =>  $validated['duration'],            

            'base_cost' => $validated['baseCost'],
            'extra_cost' => $validated['extraCost'],
            'brutto_total_amount' => $validated['bruttoTotalAmount'],
            
            'has_extra_dirt' => $validated['hasExtraDirt'],
            'has_animal_hair' => $validated['hasAnimalHair'],        

            'phone' => $validated['phone'],                                        
            'notes' => $validated['notes'],                      

            'gw_vat_number' => config('greenwiperz.company.mwst_id'),
            'gw_company_name' => config('greenwiperz.company.name'),
            'gw_street' => config('greenwiperz.company.street'),
            'gw_postal_code' =>  config('greenwiperz.company.postal_code') ,
            'gw_city' =>  config('greenwiperz.company.city') ,
            'gw_country'  => config('greenwiperz.company.country'), 
        ]);                 

        $booking->car()->create
        ([
            'car_model' => $validated['carModel'],
            'car_color' => $validated['carColor'],
            'number_plate' => $validated['numberPlate'],
            'car_size' => $validated['carSize'],  
        ]); 
        $booking->billingAddress()->create
        ([
            'first_name' => $validated['billFirstName'],
            'last_name' => $validated['billLastName'],
            'company_name' => $validated['billCompanyName'],            
            'street' => $validated['billStreet'],  
            'postal_code' => $validated['billPostalCode'],
            'city' => $validated['billCity'],
            'country' => $validated['billCountry'],
        ]);
                      
        $this->updateUserAddressAndCar($validated);
        return redirect()->route('bookings.review', ['booking' => $booking]);       
    }


    public function updateUserAddressAndCar($validated)
    {
        $user = auth()->user();

        if(filled($user->car)) 
        {
        $user->car()->update(
            [
                'car_model' => $validated['carModel'],
                'car_color' => $validated['carColor'],
                'number_plate' => $validated['numberPlate'],
                'car_size' => $validated['carSize'],  
            ]);
        } else {
            $user->car()->create(
            [
                'car_model' => $validated['carModel'],
                'car_color' => $validated['carColor'],
                'number_plate' => $validated['numberPlate'],
                'car_size' => $validated['carSize'],  
            ]);
        }
       
        
        if(filled($user->billingAddress)) 
        {
            $user->billingAddress()->update([
                'first_name' => $validated['billFirstName'],
                'last_name' => $validated['billLastName'],
                'company_name' => $validated['billCompanyName'],            
                'street' => $validated['billStreet'],  
                'postal_code' => $validated['billPostalCode'],
                'city' => $validated['billCity'],
                'country' => $validated['billCountry'],
            ]);
        } else 
        {
            $user->billingAddress()->create([
                'first_name' => $validated['billFirstName'],
                'last_name' => $validated['billLastName'],
                'company_name' => $validated['billCompanyName'],            
                'street' => $validated['billStreet'],  
                'postal_code' => $validated['billPostalCode'],
                'city' => $validated['billCity'],
                'country' => $validated['billCountry'],
            ]);
        }
    }

    protected function validateRequest() 
    {
        return request()->validate([
            'assignedTo' => 'required',                        
            'locStreetNumber' => 'required',
            'locRoute' => 'required',
            'locCity' => 'required',
            'locPostalCode' => 'required',            
            'serviceType' => 'required',
            'duration' => 'required|numeric',
            'baseCost' => 'required|numeric',
            'extraCost' => 'required|numeric',
            'bruttoTotalAmount' => 'required|numeric',
            'hasExtraDirt' => 'required',
            'hasAnimalHair' => 'required', 
            'carModel' =>  'required',    
            'numberPlate' => 'required',          
            'carColor' => 'required',
            'carSize' => 'required',
            'bookingDate' => 'required',
            'bookingTime' => 'required',
            'notes' => 'nullable',
            'phone' => 'nullable',
            'billFirstName' => 'required',
            'billLastName' => 'required',  
            'billCompanyName' => 'nullable',                    
            'billStreet' => 'required',
            'billPostalCode' => 'required',
            'billCity' => 'required',
            'billCountry' => 'required',
        ]); 
        
    }
    
    
    public function destroy(Request $request, Booking $booking)
    {                          
        if( $booking->appointment) 
        {
            $booking->appointment->delete();
        }
        $booking->billingAddress->delete();      
        $booking->car->delete();
        $booking->delete();    
        
        $request->session()->flash('message',
        [
            'color'=>'green',
            'title'=>'Booking deleted', 
            'description'=>'The booking has been successfully deleted'
        ]);
        return redirect()->route('bookings.index');
    }

    
    public function showInvoice(Booking $booking) {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.invoice_de', ['booking' => $booking]);    
        return $pdf->stream();
    }

    public function showReceipt(Booking $booking){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.receipt_de', ['booking' => $booking]); 
        return $pdf->stream();  
    }

    public function showRefund(Booking $booking){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.refund_de', ['booking' => $booking]); 
        return $pdf->stream();  
    }
    
    protected function generateBaseNumber()
    {       
        $baseNumberStructure = [            
            'date' => Carbon::now('GMT+2')->format('U'),
            'divider2' => '-',
            'userid' => str_pad(auth()->user()->id, 4, "0", STR_PAD_LEFT),
        ];
        return implode($baseNumberStructure);
    }

    protected function generateRefundNumber()
    {       
        $baseNumberStructure = [     
            'receipt_id' => 'REF',       
            'date' => Carbon::now('GMT+2')->format('U'),
            'divider2' => '-',
            'userid' => str_pad(auth()->user()->id, 4, "0", STR_PAD_LEFT),
        ];
        return implode($baseNumberStructure);
    }

}
