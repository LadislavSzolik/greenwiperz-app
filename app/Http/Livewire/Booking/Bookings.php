<?php
/**
 * This file is part of the Greenwiperz project.
 *
 * LICENSE: This source file is subject to version 3.14 of the PrStart license
 * that is available through the world-wide-web at the following URI:
 * https://www.prstart.co.uk/license/  If you did not receive a copy of
 * the PrStart License and are unable to obtain it through the web, please
 * send a note to imre@prstart.co.uk so we can mail you a copy immediately.
 *
 * DESCRIPTION: Greenwiperz
 *
 * @category   Laravel
 * @package    Greenwiperz
 * @author     Imre Szeness <imre@prstart.co.uk>
 * @copyright  Copyright (c) 2021 PrStart Ltd. (https://www.prstart.co.uk)
 * @license    https://www.prstart.co.uk/license/ PrStart Ltd. License
 * @version    1.0.0 (02/02/2021)
 * @link       https://www.prstart.co.uk/laravel-development/greenwiperz/
 * @since      File available since Release 1.0.0
 */

declare(strict_types=1);

namespace App\Http\Livewire\Booking;

use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Booking;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class Bookings
 * @package App\Http\Livewire\Booking
 */
class Bookings extends Component
{
    use WithPagination;
    use WithSorting;

    /** @var string[]  */
    protected $queryString = ['sortField','sortDirection'];

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->sortField = 'date';
        $this->sortDirection = 'desc';
    }

    /**
     * @return mixed
     */
    public function getRowsProperty()
    {
        $isGreenwiper = auth()->user()->isGreenwiper();

        $query = Booking::query()
        ->when(!$isGreenwiper, fn($query) => $query->where('customer_id', auth()->user()->id));
        return $this->applySorting($query)->paginate(10);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.booking.bookings', ['bookings'=> $this->rows]);
    }
}
