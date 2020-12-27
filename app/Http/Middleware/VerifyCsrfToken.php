<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'userRegistration',
        'mobileOtpVerifyAjax',
        'getStates',
        'getCities',
        'forgotPassword',
        'resetPassword/*',
        'login',
        'user/changePassword',
        '/user/editProfile',
        '/user/address/add',
        '/user/address/editModal/*',
        '/user/address/update',
        '/user/card/editModal/*',
        '/user/card/update',
        '/user/card/default/update',
        '/user/address/default/update',
        'provider/*',
        'memberSignup/home',
        'registered-card-types',
        'registered-store_location',
        'provider/invoice-image',
        '/user/requestForProposal',
        '/user/requestForProposal/*',
        'delete/image',
        'user/trackRFPRequest',
        'registerToken',
        '/user/*',
        '/deliverWithUsRegistration/*',
        '/deliverWithUsRegistration',
        '/admin/buildMartFees/range/add',
        '/admin/buildMartFees/range/check',
        '/admin/specialBuildMartFees/range/add',
        '/admin/specialBuildMartFees/range/check',
        'admin/refundApproval/refund/status',
        'admin/refundApproval/updated/RefundProduct/status/ByAdmin',

    ];
}
