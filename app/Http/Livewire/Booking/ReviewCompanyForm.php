<?php
/**
 *
 */

declare(strict_types=1);

namespace App\Http\Livewire\Booking;

use App\Events\BusinessBookingEntered;
use App\Models\Booking;
use App\Models\Fleet;
use Livewire\Component;

/**
 * Class ReviewCompanyForm
 * @package App\Http\Livewire\Booking
 */
class ReviewCompanyForm extends Component
{
    public Booking $booking;

    public Fleet $smallCars;
    public Fleet $mediumCars;
    public Fleet $largeCars;
    public Fleet $xlargeCars;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->smallCars = $this->booking->fleets()->where('car_size','=','small')->first() ?? Fleet::make();
        $this->mediumCars = $this->booking->fleets()->where('car_size','=','medium')->first() ?? Fleet::make();
        $this->largeCars = $this->booking->fleets()->where('car_size','=','large')->first() ?? Fleet::make();
        $this->xlargeCars = $this->booking->fleets()->where('car_size','=','x-large')->first() ?? Fleet::make();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        $this->booking->billingAddress()->delete();
        return redirect()->route('bookings.company.create');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function submit()
    {
        session()->flash('message',
        [
            'color'=>'green',
            'title'=>'Confirmation',
            'description'=>'Thank you very much for your order, we have recorded the cleaning in our system. Our staff will contact you shortly by phone to clarify the exact time.'
        ]);

        $this->booking->status = 'pending';
        $this->booking->tc_accepted_at = now();
        $this->booking->save();

        event(new BusinessBookingEntered($this->booking));

        return redirect(route('bookings.show', ['booking'=>$this->booking->id]));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.booking.review-company-form');
    }
}
