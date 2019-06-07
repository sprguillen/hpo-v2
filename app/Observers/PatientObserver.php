<?php

namespace App\Observers;

use App\Models\Patient;

class PatientObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(Patient $patient)
    {
        $id = global_prefix() . $patient->id . \Carbon\Carbon::now()->timestamp;
        $patient->code = int_to_code($patient->id);
        $patient->global_custom_id = $id;
        $patient->hpo_patient_id = $id;
        $patient->save();
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
