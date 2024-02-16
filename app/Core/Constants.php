<?php

namespace App\Core;

class Constants
{
    const Onboarding_Total_Step_Count = 9;
    const Role_Manager = 5;
    const Role_User = 3;
    const Location_Settings_CheckInCode = 'LocationCheckInCode';
    const User_Settings_Onboarding = 'Onboarding';


    // Define a mapping of human-readable names
    public static $constantMap = [
        'LocationCheckInCode' => 'Check-In Code',
        'Onboarding' => 'Onboarding',
        
    ];
}
