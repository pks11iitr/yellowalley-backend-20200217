<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $user->referral_code=$this->generateReferralCode($user->id);
        $user->save();
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


    public function generateReferralCode($id){
        $prefix='YAL';
        $count=$id;
        if($count<10){
            $referral_code='000'.$count;
        }else if($count<100){
            $referral_code='00'.$count;
        }else if($count<1000){
            $referral_code='0'.$count;
        }else{
            $referral_code=''.$count;
        }
        return $prefix.$referral_code;
    }
}
