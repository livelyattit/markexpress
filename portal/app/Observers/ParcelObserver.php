<?php

namespace App\Observers;

use App\Parcel;

class ParcelObserver
{
    /**
     * Handle the parcel "created" event.
     *
     * @param  \App\Parcel  $parcel
     * @return void
     */
    public function created(Parcel $parcel)
    {
        $amount = ($parcel->amount != NULL) ? $parcel->amount : 0;
        $basic_charges = ($parcel->t_basic_charges != NULL) ? $parcel->t_basic_charges : 0;
        $booking_charges = ($parcel->t_booking_charges != NULL) ? $parcel->t_booking_charges : 0;
        $cash_handling_charges = ($parcel->t_cash_handling_charges != NULL) ? $parcel->t_cash_handling_charges : 0;
        $packing_charges = ($parcel->t_packing_charges != NULL) ? $parcel->t_packing_charges : 0;


        $total_charges = $basic_charges + $booking_charges + $cash_handling_charges + $packing_charges;
        $remaining_charges = $amount - $total_charges;


        $parcel->total_delivery_amount = $total_charges;
        $parcel->remaining_amount = $remaining_charges;
        $parcel->save();
    }

    /**
     * Handle the parcel "updated" event.
     *
     * @param  \App\Parcel  $parcel
     * @return void
     */
    public function updated(Parcel $parcel)
    {
        //
    }

    /**
     * Handle the parcel "deleted" event.
     *
     * @param  \App\Parcel  $parcel
     * @return void
     */
    public function deleted(Parcel $parcel)
    {
        //
    }

    /**
     * Handle the parcel "restored" event.
     *
     * @param  \App\Parcel  $parcel
     * @return void
     */
    public function restored(Parcel $parcel)
    {
        //
    }

    /**
     * Handle the parcel "force deleted" event.
     *
     * @param  \App\Parcel  $parcel
     * @return void
     */
    public function forceDeleted(Parcel $parcel)
    {
        //
    }
}
