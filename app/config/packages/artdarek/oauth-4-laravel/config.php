<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | oAuth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Storage
     */
    'storage'   => 'Session',

    /**
     * Consumers
     */
    'consumers' => array(

        /**
         * Facebook
         */
        'Facebook' => array(
            'client_id'     => '895668743799502',
            'client_secret' => 'c532ab66a02d100a3a3dbcd9cf9fb8c0',
            'scope'         => ['email', 'read_friendlists', 'user_online_presence'],
        ),
        'Google'   => array(
            'client_id'     => '733219970296-u650hlbiqgr58kr66ob2228jhlmsgaa8.apps.googleusercontent.com',
            'client_secret' => 'TDfle7W_uzSzQ_hcvytNgVQL',
            'scope'         => ['userinfo_email', 'userinfo_profile'],
        ),

    )

);