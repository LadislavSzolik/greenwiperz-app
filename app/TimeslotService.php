<?php

namespace App;

use Illuminate\Support\Facades\DB;


class TimeslotService
{
    public $serviceDurationTime;
    public $date;
    public $availableTimeslots;

    public function __construct($date, $serviceDurationTime) {
      $this->date = $date;
      $this->serviceDurationTime = $serviceDurationTime;
    }

    public function fetchSlotsWith($date, $serviceDurationTime) {
      $this->date = $date;
      $this->serviceDurationTime = $serviceDurationTime;
      return $this->fetchSlots();
    }


    public function fetchSlots() {
      $bookedTimeslots = DB::table('timeslots')->select('timeslots.id as takenTimeSlotId', 'timeslot')->crossJoin('booking_timeslots')->where([['booking_timeslots.date', $this->date],['booking_timeslots.deleted_at', null]])->where(function ($query) {
          $query->whereBetween('booking_timeslots.start_time', [DB::raw('timeslots.timeslot'), DB::raw("DATE_ADD(timeslots.timeslot, INTERVAL '$this->serviceDurationTime' minute)")])->orWhereBetween('booking_timeslots.end_time', [DB::raw('timeslots.timeslot'), DB::raw("DATE_ADD(timeslots.timeslot, INTERVAL '$this->serviceDurationTime' minute)")])->orWhereBetween('timeslots.timeslot', [DB::raw('booking_timeslots.start_time'), DB::raw('booking_timeslots.end_time')]);
      });

      $this->availableTimeslots= DB::table('timeslots as availableSlots')->select('availableSlots.timeslot')->leftJoinSub($bookedTimeslots, 'disabledTimeSlots', function ($join) {
          $join->on('availableSlots.id', '=', 'disabledTimeSlots.takenTimeSlotId');
      })->whereNull('disabledTimeSlots.takenTimeSlotId')->get();

      return $this->availableTimeslots;
    }
}
