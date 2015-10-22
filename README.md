This plugin is a modification of the main OAuth2 Moodle plugin to enable OAuth2 sign-in via the CRANAplus Identity Provider.

### Installation:
1. add the plugin into /auth/googleoauth2/
2. in the Moodle administration, enable the plugin (Admin block > Plugins > Authentication)
3. in the plugin settings, follow the displayed instructions.

### Custom Provider
We have added `/classes/provider/crana.php` as the custom provider.

### Composer (for devs)
The library includes the entire vendor content in the repository (so don't run composer). It makes it for me easy to download the zip file from Github and then to upload it straight away in Moodle.org. 
Moodle.org is not able to create a package from Github (with vendor libs) yet.

### Credits
* [Contributors](https://github.com/mouneyrac/auth_googleoauth2/graphs/contributors)
* [The PHP League oauth2 client](https://github.com/thephpleague/oauth2-client)
* [Pixelfear dropbox support](https://github.com/pixelfear/oauth2-dropbox)
* [Depotwarehouse battle.net support](https://github.com/tpavlek/oauth2-bnet)
* [Guzzle](http://docs.guzzlephp.org/en/latest/)
* [illuminate contracts](https://github.com/illuminate/contracts)
* [Symfony EventDispatcher](http://symfony.com/)

### +1 the plugin
To like the plugin, go to the [Moodle.org repository plugin page](https://moodle.org/plugins/view/auth_googleoauth2), login and click on 'Add to my Favorites'. Find other ways to contribute on the [github plugin page](http://mouneyrac.github.io/moodle-auth_googleoauth2/).

