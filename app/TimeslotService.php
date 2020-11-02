<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class TimeslotService
{

    public static function fetchSlots($date, $travelTime, $serviceDurationTime) {
      $bookedTimeslots = DB::table('timeslots')
      ->select('timeslots.id as takenTimeSlotId', 'timeslot')
      ->crossJoin('booking_timeslots')
      ->where([['booking_timeslots.date', $date],['booking_timeslots.deleted_at', null]])
      ->where(function ($query) use ($serviceDurationTime) {
          $query->whereBetween('booking_timeslots.start_time', [DB::raw('timeslots.timeslot'), DB::raw("DATE_ADD(timeslots.timeslot, INTERVAL $serviceDurationTime minute)")])
          ->orWhereBetween('booking_timeslots.end_time', [DB::raw('timeslots.timeslot'), DB::raw("DATE_ADD(timeslots.timeslot, INTERVAL $serviceDurationTime minute)")])
          ->orWhereBetween('timeslots.timeslot', [DB::raw('booking_timeslots.start_time'), DB::raw('booking_timeslots.end_time')]);
      });

      $availableTimeslots= DB::table('timeslots as availableSlots')->select('availableSlots.timeslot')->leftJoinSub($bookedTimeslots, 'disabledTimeSlots', function ($join) {
          $join->on('availableSlots.id', '=', 'disabledTimeSlots.takenTimeSlotId');
      })->whereNull('disabledTimeSlots.takenTimeSlotId')->get();

      // map to presentable format
      $timeslotForClient = $availableTimeslots->map( function($timeslot) use ($travelTime) {
        return Carbon::parse($timeslot->timeslot)->addMinutes($travelTime)->format('H:i');
      } );

      if(self::isSaturday($date)) {
        $onlyHalfDay = $timeslotForClient->filter(function ($timeslot, $key) {
          return Carbon::parse($timeslot)->lt(Carbon::parse('12:15:00'));
       });
       return $onlyHalfDay;
      }
     
      return $timeslotForClient;
    }

    public static function isSaturday($date) {
      return Carbon::parse($date)->dayOfWeek == 6;
    }
}
