<?php

namespace App\Observers;

use App\Models\Patient;

class PatientObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Patient  $patient
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
     * @param  \App\Patient  $patient
     * @return void
     */
    public function updated(Patient $patient)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Patient  $patient
     * @return void
     */
    public function deleted(Patient $patient)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $patient
     * @return void
     */
    public function restored(User $patient)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Patient  $patient
     * @return void
     */
    public function forceDeleted(Patient $patient)
    {
        //
    }
}
