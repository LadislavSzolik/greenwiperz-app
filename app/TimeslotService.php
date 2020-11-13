<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class TimeslotService
{

    public static function fetchSlots($date, $userId, $travelTime, $serviceDurationTime) {
      $bookedTimeslots = DB::table('timeslots')
      ->select('timeslots.id as takenTimeSlotId', 'timeslot')
      ->crossJoin('appointments')
      ->where([['appointments.date', $date],['appointments.canceled_at', null],['appointments.assigned_to', $userId]])      
      ->where(function ($query) use ($serviceDurationTime) {
          $query->whereBetween('appointments.start_time', [DB::raw('timeslots.timeslot'), DB::raw("DATE_ADD(timeslots.timeslot, INTERVAL $serviceDurationTime minute)")])
          ->orWhereBetween('appointments.end_time', [DB::raw('timeslots.timeslot'), DB::raw("DATE_ADD(timeslots.timeslot, INTERVAL $serviceDurationTime minute)")])
          ->orWhereBetween('timeslots.timeslot', [DB::raw('appointments.start_time'), DB::raw('appointments.end_time')]);
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
