<x-base-layout>

    {{ theme()->getView('pages/account/_navbar', array('class' => 'mb-5 mb-xl-10', 'info' => $info)) }}

    {{ theme()->getView('pages/account/settings/_profile-details', array('class' => 'mb-5 mb-xl-10', 'info' => $info)) }}

    {{ theme()->getView('pages/account/settings/_notification-method', array('class' => 'mb-5 mb-xl-10', 'info' => $info)) }}

    {{ theme()->getView('pages/account/settings/_signin-method', array('class' => 'mb-5 mb-xl-10', 'info' => $info)) }}

    {{ theme()->getView('partials/modals/two-factor-authentication/_main', array('disableCurrent' => true )) }}

</x-base-layout>
