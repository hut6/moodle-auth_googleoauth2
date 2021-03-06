<?php
// This file is part of Oauth2 authentication plugin for Moodle.
//
// Oauth2 authentication plugin for Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Oauth2 authentication plugin for Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Oauth2 authentication plugin for Moodle.  If not, see <http://www.gnu.org/licenses/>.

require_once($CFG->dirroot . '/auth/googleoauth2/vendor/autoload.php');

class provideroauth2crana extends \League\OAuth2\Client\Provider\AbstractProvider {

    public $sskstyle = 'crana';
    public $name = 'crana'; // It must be the same as the XXXXX in the class name provideroauth2XXXXX.
    public $readablename = 'CRANAplus';
    public $scopes = array();
    public $base; // Base URL

    /**
     * Constructor.
     *
     * @throws Exception
     * @throws dml_exception
     */
    public function __construct() {
        global $CFG;

        $this->base = get_config('auth/googleoauth2', $this->name . 'base');

        parent::__construct([
            'clientId'      => get_config('auth/googleoauth2', $this->name . 'clientid'),
            'clientSecret'  => get_config('auth/googleoauth2', $this->name . 'clientsecret'),
            'redirectUri'   => preg_replace('/http:/',
                'https:', $CFG->httpswwwroot .'/auth/googleoauth2/' . $this->name . '_redirect.php', 1),
            'scopes'        => $this->scopes
        ]);
    }

    /**
     * Is the provider enabled.
     *
     * @return bool
     * @throws Exception
     * @throws dml_exception
     */
    public function isenabled() {
        return (get_config('auth/googleoauth2', $this->name . 'base')
            && get_config('auth/googleoauth2', $this->name . 'clientid')
            && get_config('auth/googleoauth2', $this->name . 'clientsecret'));
    }

    /**
     * The html button.
     *
     * @param $authurl
     * @param $providerdisplaystyle
     * @return string
     * @throws coding_exception
     */
    public function html_button($authurl, $providerdisplaystyle) {
        return googleoauth2_html_button($authurl, $providerdisplaystyle, $this);
    }

    /**
     * Get the URL that this provider uses to begin authorization.
     *
     * @return string
     */
    public function urlAuthorize()
    {
        return $this->base . '/oauth/v2/auth';
    }

    /**
     * Get the URL that this provider users to request an access token.
     *
     * @return string
     */
    public function urlAccessToken()
    {
        return $this->base . '/oauth/v2/token?grant_type=authorization_code';
    }

    /**
     * Get the URL that this provider uses to request user details.
     *
     * Since this URL is typically an authorized route, most providers will require you to pass the access_token as
     * a parameter to the request. For example, the google url is:
     *
     * 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token='.$token
     *
     * @param \League\OAuth2\Client\Token\AccessToken $token
     * @return string
     */
    public function urlUserDetails(\League\OAuth2\Client\Token\AccessToken $token)
    {
        return $this->base . '/api/v2/user?access_token=' . $token;
    }

    public function userDetails($response, \League\OAuth2\Client\Token\AccessToken $token)
    {
        $response = (array) $response;

        $user = new \League\OAuth2\Client\Entity\User();

        $user->exchangeArray([
            'uid' => $response['id'],
            'name' => $response['name'],
            'email' => $response['email']
        ]);

        return $user;
    }
}