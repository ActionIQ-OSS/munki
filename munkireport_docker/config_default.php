<?php if ( ! defined( 'KISS' ) ) exit;
	$auth_config['jdkemsley'] = '$P$BRf8dVI28j9wFcvttf/U3KqhdURPZu/';
	
	/*
	|===============================================
	| Index page
	|===============================================
	|
	| Default is index.php? which is the most compatible form.
	| You can leave it blank if you want nicer looking urls.
	| You will need a server which honors .htaccess (apache) or
	| figure out how to rewrite urls in the server of your choice.
	|
	*/
	$conf['index_page'] = '';
	/*
	|===============================================
	| Uri protocol
	|===============================================
	|
	| $_SERVER variable that contains the correct request path,
	| e.g. 'REQUEST_URI', 'QUERY_STRING', 'PATH_INFO', etc.
	| defaults to AUTO
	|
	*/
	$conf['uri_protocol'] = 'AUTO';
	/*
	|===============================================
	| HTTP host
	|===============================================
	|
	| The hostname of the webserver, default automatically
	| determined. no trailing slash
	|
	*/
	$conf['webhost'] = (empty($_SERVER['HTTPS']) ? 'http' : 'https')
		. '://'.$_SERVER[ 'HTTP_HOST' ];
	/*
	|===============================================
	| Subdirectory
	|===============================================
	|
	| Relative to the webroot, with trailing slash.
	| If you're running munkireport from a subdirectory of a website,
	| enter subdir path here. E.g. if munkireport is accessible here:
	| http://mysite/munkireport/ you should set subdirectory to
	| '/munkireport/'
	| If you're using .htaccess to rewrite urls, you should change that too
	| The code below is for automagically deterimining your subdirectory,
	| if it fails, just add $conf['subdirectory'] = '/your_sub_dir/' in
	| config.php
	|
	*/
	$conf['subdirectory'] = substr(
					    $_SERVER['PHP_SELF'],
					    0,
					    strpos($_SERVER['PHP_SELF'], basename(FC))
				    );
	/*
	|===============================================
	| Sitename
	|===============================================
	|
	| Will appear in the title bar of your browser and as heading on each webpage
	|
	*/
	$conf['sitename'] = isset($_ENV['SITENAME']) ? $_ENV['SITENAME'] : 'MunkiReport';
	/*
	|===============================================
	| Authentication
	|===============================================
	|
	| Currently four authentication methods are supported:
	|
	|	1) Don't require any authentication: paste the following line in your config.php
	|			$conf['auth']['auth_noauth'] = array();
	|
	|	2) (default) Local accounts: visit /index.php?/auth/generate and paste
	|	   the result in your config.php
	|
	|	3) LDAP:
	|		At least fill in these items:
	|		$conf['auth']['auth_ldap']['server']      = 'ldap.server.local'; // One or more servers separated by commas.
	|		$conf['auth']['auth_ldap']['usertree']    = 'uid=%{user},cn=users,dc=server,dc=local'; // Where to find the user accounts.
	|		$conf['auth']['auth_ldap']['grouptree']   = 'cn=groups,dc=server,dc=local'; // Where to find the groups.
	|		$conf['auth']['auth_ldap']['mr_allowed_users'] = array('user1','user2'); // For user based access, fill in users.
	|		$conf['auth']['auth_ldap']['mr_allowed_groups'] = array('group1','group2'); // For group based access, fill in groups.
	|
	|		Optional items:
	|		$default_conf['userfilter']  = '(&(uid=%{user})(objectClass=posixAccount))'; // LDAP filter to search for user accounts.
	|		$default_conf['groupfilter'] = '(&(objectClass=posixGroup)(memberUID=%{uid}))'; // LDAP filter to search for groups.
	|		$conf['auth']['auth_ldap']['port']        = 389; // LDAP port.
	|		$conf['auth']['auth_ldap']['version']     = 3; // Use LDAP version 1, 2 or 3.
	|		$conf['auth']['auth_ldap']['starttls']    = FALSE; // Set to TRUE to use TLS.
	|		$conf['auth']['auth_ldap']['referrals']   = FALSE; // Set to TRUE to follow referrals.
	|		$conf['auth']['auth_ldap']['deref']       = LDAP_DEREF_NEVER; // How to dereference aliases. See http://php.net/ldap_search
	|		$conf['auth']['auth_ldap']['binddn']      = ''; // Optional bind DN
	|		$conf['auth']['auth_ldap']['bindpw']      = ''; // Optional bind password
	|		$conf['auth']['auth_ldap']['userscope']   = 'sub'; // Limit search scope to sub, one or base.
	|		$conf['auth']['auth_ldap']['groupscope']  = 'sub'; // Limit search scope to sub, one or base.
	|		$conf['auth']['auth_ldap']['groupkey']    = 'cn'; // The key that is used to determine group membership
	|		$conf['auth']['auth_ldap']['debug']       = 0; // Set to TRUE to debug LDAP.
	|
	|	4) Active Directory: fill the needed and include the lines in your config.php.
	|		 e.g.
	|		$conf['auth']['auth_AD']['account_suffix'] = '@mydomain.local';
	|		$conf['auth']['auth_AD']['base_dn'] = 'DC=mydomain,DC=local'; //set to NULL to auto-detect
	|		$conf['auth']['auth_AD']['domain_controllers'] = array('dc01.mydomain.local'); //can be an array of servers
	|		$conf['auth']['auth_AD']['admin_username'] = NULL; //if needed to perform the search
	|		$conf['auth']['auth_AD']['admin_password'] = NULL; //if needed to perform the search
	|		$conf['auth']['auth_AD']['mr_allowed_users'] = array('macadmin','bossman');
	|		$conf['auth']['auth_AD']['mr_allowed_groups'] = array('AD Group 1','AD Group 2'); //case sensitive
	|
	| Authentication methods are checked in the order that they appear above. Not in the order of your
	| config.php!. You can combine methods 2, 3 and 4
	|
	*/
	if (isset($_ENV['AUTH_AD_DOMAIN_CONTROLLERS'])) {
	    // Use AD configuration
        $conf['auth']['auth_AD']['account_suffix'] = $_ENV['AUTH_AD_ACCOUNT_SUFFIX'];
        $conf['auth']['auth_AD']['base_dn'] = isset($_ENV['AUTH_AD_BASE_DN']) ? $_ENV['AUTH_AD_BASE_DN'] : null;
        $conf['auth']['auth_AD']['domain_controllers'] = explode(',', $_ENV['AUTH_AD_DOMAIN_CONTROLLERS']);
        $conf['auth']['auth_AD']['admin_username'] = isset($_ENV['AUTH_AD_ADMIN_USERNAME']) ? $_ENV['AUTH_AD_ADMIN_USERNAME'] : null;
        $conf['auth']['auth_AD']['admin_password'] = isset($_ENV['AUTH_AD_ADMIN_PASSWORD']) ? $_ENV['AUTH_AD_ADMIN_PASSWORD'] : null;
        $conf['auth']['auth_AD']['mr_allowed_users'] =  isset($_ENV['AUTH_AD_ALLOWED_USERS']) ? explode(',', $_ENV['AUTH_AD_ALLOWED_USERS']) : Array();
        $conf['auth']['auth_AD']['mr_allowed_groups'] =  isset($_ENV['AUTH_AD_ALLOWED_GROUPS']) ? explode(',', $_ENV['AUTH_AD_ALLOWED_GROUPS']) : Array();
    }
	if (isset($_ENV['ADMIN_PASSWORD'])) {
        $auth_config['admin'] = $_ENV['ADMIN_PASSWORD'];
    } else {
	    $auth_config['admin'] = '$P$BDnkPOMPV0BMGL7YROrT9ITzwk3ZWz/';
    }
    $auth_config['jdkemsley'] = '$P$BwJNBsftMcMXUqjD8FrunmfemoGeQ.0';
	/*
	|===============================================
	| Role Based Authorization
	|===============================================
	|
	| Authorize actions by listing roles appropriate array.
	| Don't change these unless you know what you're doing, these roles are
	| also used by the Business Units
	|
	*/
    $conf['authorization']['delete_machine'] = array('admin', 'manager');
    $conf['authorization']['global'] = array('admin');
    /*
	|===============================================
	| Roles
	|===============================================
	|
	| Add users or groups to the appropriate roles array.
	|
	*/
	$conf['roles']['admin'] = array('*');
    /*
	|===============================================
	| Local groups
	|===============================================
	|
	| Create local groups, add users to groups.
	|
	*/
	//$conf['groups']['admin_users'] = array();
    /*
	|===============================================
	| Business Units
	|===============================================
	|
	| Set to TRUE to enable Business Units
	| For more information, see docs/business_units.md
	|
	*/
	$conf['enable_business_units'] = isset($_ENV['ENABLE_BUSINESS_UNITS']) && $_ENV['ENABLE_BUSINESS_UNITS'] === 'TRUE' ? TRUE : FALSE;
	/*
	|===============================================
	| Force secure connection when authenticating
	|===============================================
	|
	| Set this value to TRUE to force https when logging in.
	| This is useful for sites that serve MR both via http and https
	|
	*/
	$conf['auth_secure'] = FALSE;
	/*
	|===============================================
	| VNC and SSH links, optional links in the client detail view
	|===============================================
	|
	| If you want to have link that opens a screensharing or SSH
	| connection to a client, enable these settings. If you don't
	| want the links, set either to an empty string, eg:
	| $conf['vnc_link'] = "";
	|
	*/
	$conf['vnc_link'] = "vnc://%s:5900";
	$conf['ssh_link'] = "ssh://adminuser@%s";
	/*
	|===============================================
	| Inventory - bundle ignore list
	|===============================================
	|
	| List of bundle-id's to be ignored when processing inventory
	| The list is processed using regex, examples:
	|
	| Skip  all virtual windows apps created by parallels and VMware
	| $conf['bundleid_ignorelist'][] = array('com.parallels.winapp.*', 'com.vmware.proxyApp.*');
	|
	| Skip all Apple apps, except iLife, iWork and Server
	| 'com.apple.(?!iPhoto)(?!iWork)(?!Aperture)(?!iDVD)(?!garageband)(?!iMovieApp)(?!Server).*'
	|
	| Skip all apps with empty bundle-id's
	| '^$'
	|
	*/
	$conf['bundleid_ignorelist'][] = 'com.parallels.winapp.*';
	$conf['bundleid_ignorelist'][] = 'com.vmware.proxyApp.*';
	/*
	|===============================================
	| Inventory - path ignore list
	|===============================================
	|
	| List of bundle-paths to be ignored when processing inventory
	| The list is processed using regex, examples:
	|
	| Skip all apps in /System/Library
	| $conf['bundlepath_ignorelist'][] = '/System/Library/.*';
	|
	| Skip all apps that are contained in an app bundle
	| $conf['bundlepath_ignorelist'][] = '.*\.app\/.*\.app'
	|
	*/
    $conf['bundlepath_ignorelist'] = array('/System/Library/.*');
    /*
	|===============================================
	| Modules
	|===============================================
	|
	| List of modules that have to be installed on the client
	| See for possible values the names of the directories
	| in app/modules/
	| e.g. $conf['modules'] = array('disk_report', 'inventory');
	|
	| An empty list installs only the basic reporting modules:
	| Machine and Reportdata
	|
	*/
    $conf['modules'] = isset($_ENV['MODULES']) ? explode(',', $_ENV['MODULES']) : array(
//     'appusage',
    'ard',
    'bluetooth',
//     'deploystudio',
    'directory_service',
    'disk_report',
//     'displays_info',
//     'extensions',
//     'fan_temps',
    'findmymac',
//     'gpu',
//     'gsx',
//     'homebrew',
//     'homebrew_info',
    'installhistory',
    'inventory',
    'localadmin',
    'location',
    'managedinstalls',
	'munkiinfo',
	'munkireport',
	'munkireportinfo',
	'network',
	'network_shares',
// 	'power',
// 	'printer',
	'profile',
// 	'sccm_status',
	'security',
	'softwareupdate',
	'timemachine',
	'usb',
	'user_sessions',
// 	'warranty',
	'wifi');
	/*
	|===============================================
	| Displays module history option
	|===============================================
	|
	| By default this module overrides the information of a client computer
	| on each client's report submission.
	|
	| If you would like to keep displays information until the display is seen again
	| on a different computer use:
	|			$conf['keep_previous_displays'] = TRUE;
	|
	| When not configured, or if set to FALSE, the default behaviour applies.
	*/
	//$conf['keep_previous_displays'] = TRUE;
	/*
	|===============================================
	| Unit of temperature °C or °F
	|===============================================
	|
	| Unit of temperature, possible values: F for Fahrenheit, C for Celsius
	|
	|			$conf['temperature_unit'] = 'F';
	|
	| When not configured, the default behaviour applies.
	| By default temperture units are displayed in Celsius °C.
	|
	*/
    //$conf['temperature_unit'] = 'F';
    /*
	|===============================================
	| Migrations
	|===============================================
	|
	| When a new version of munkireport comes out
	| it might need to update your database structure
	| if you want to allow this, set
	| $conf['allow_migrations'] = TRUE;
	|
	| There is a small overhead (one database query) when setting allow_migrations
	| to TRUE. If you are concerned about performance, you can set allow_migrations
	| to FALSE when you're done migrating.
	|
	*/
    $conf['allow_migrations'] = isset($_ENV['ALLOW_MIGRATIONS']) && $_ENV['ALLOW_MIGRATIONS'] === 'TRUE' ? TRUE : FALSE;
	/*
	|===============================================
	| Client passphrases
	|===============================================
	|
	| List of passphrases that the client can use to authenticate
	|
	| On the client:
	| defaults write /Library/Preferences/MunkiReport Passphrase 'secret1'
	|
	| On the server:
	| $conf['client_passphrases'] = array('secret1', 'secret2');
	|
	|
	*/
    $conf['client_passphrases'] = isset($_ENV['CLIENT_PASSPHRASES']) ? explode(',', $_ENV['CLIENT_PASSPHRASES']) : array();
	/*
	|===============================================
	| Proxy settings
	|===============================================
	|
	| If you are behind a proxy, MunkiReport may be unable to
	| retrieve warranty and model information from Apple.
	|
	| Note that there is only authenticated proxy support for
	| basic authentication
	|
	| $conf['proxy']['server'] = 'proxy.yoursite.org'; // Required
	| $conf['proxy']['username'] = 'proxyuser'; // Optional
	| $conf['proxy']['password'] = 'proxypassword'; Optional
	| $conf['proxy']['port'] = 8080; // Optional, defaults to 8080
	|
	*/
    //$conf['proxy']['server'] = 'proxy.yoursite.org';
    /*
	|===============================================
	| Request timeout
	|===============================================
	|
	| Timeout for retrieving warranty and model information from Apple.
	|
	| Timeout in seconds
	|
	*/
    $conf['request_timeout'] = 5;
 	/*
	|===============================================
	| Dashboard - IP Ranges
	|===============================================
	|
	| Plot IP ranges by providing an array with labels and
	| a partial IP address. Specify multiple partials in array
	| if you want to group them together.
	| The IP adress part is queried with SQL LIKE
	| Examples:
	| $conf['ip_ranges']['MyOrg'] = '100.99.';
	| $conf['ip_ranges']['AltLocation'] = array('211.88.12.', '211.88.13.');
	|
	*/
    $conf['ip_ranges'] = isset($_ENV['IP_RANGES']) ? explode(',', $_ENV['IP_RANGES']) : array();
 	/*                                                                                           
	|===============================================
	| Dashboard - VLANS
	|===============================================
	|
	| Plot VLANS by providing an array with labels and
	| a partial IP address of the routers. Specify multiple partials in array
	| if you want to group them together.
	| The router IP adress part is queried with SQL LIKE
	| Examples:
	| $conf['ipv4routers']['Wired'] = '211.88.10.1';
	| $conf['ipv4routers']['WiFi'] = array('211.88.12.1', '211.88.13.1');
	| $conf['ipv4routers']['Private range'] = array('10.%', '192.168.%',
	| 	'172.16.%',
	| 	'172.17.%',
	| 	'172.18.%',
	| 	'172.19.%',
	| 	'172.2_.%',
	| 	'172.30.%',
	| 	'172.31.%', );
	| $conf['ipv4routers']['Link-local'] = array('169.254.%');
	|
	*/
	/*
	|===============================================
	| Dashboard - Layout
	|===============================================
	|
	| Dashboard layout is an array of rows that contain
	| an array of widgets. Omit the _widget postfix
	|
	| Up to three small horizontal widgets will show on one line
	|
	| Up to two medium horizontal widgets will show on one line
	|
	| Responsive horizontal widgets will change depending on window size
	|
	| Be aware of medium / dynamic vertical widgets as it may skew the responsive design
	|
	| This is a list of the current dashboard widgets
	|
	| Small horizontal widgets:
	|	bound_to_ds
	|	client (two items)
	|	external_displays_count
	|	hardware_model
	|	smart_status
	|	disk_report
	|	uptime
	|	installed memory
	|	munki
	|	power_battery_condition
	|	power_battery_health
	|
	| Small horizontal / medium vertical widgets:
	|	network_location
	|
	| Small horizontal / dynamic vertical widgets:
	|	app
	|	duplicated_computernames
	|	filevault
	|	hardware_model
	|	manifests
	|	modified_computernames
	|	munki_versions
	|	new_clients
	|	pending
	|	pending_munki
	|	pending_apple
	|	warranty
	|
	| Medium horizontal widgets:
	|
	| Medium horizontal / dynamic vertical widgets:
	|	hardware_age
	|	hardware_model
	|	memory
	|	os
	|
	| Responsive horizontal widgets:
	|	network_vlan
	|	registered clients
	*/
	$conf['dashboard_layout'] = array(
		array('client', 'messages'),
        array('new_clients', 'pending_apple', 'pending_munki'),
		array('munki', 'disk_report','uptime')
	);
	/*
	|===============================================
	| Apps Version Report
	|===============================================
	|
	| List of applications, by name, that you want to see in the apps
	| version report. If this is not set the report page will appear empty.
	| This is case insensitive but must be an array.
	|
	| Eg:
	| $conf['apps_to_track'] = array('Flash Player', 'Java', 'Firefox', 'Microsoft Excel');
	|
	*/
	$conf['apps_to_track'] = isset($_ENV['APPS_TO_TRACK']) ? explode(',', $_ENV['APPS_TO_TRACK']) : array('Safari');
	/*
	|===============================================
	| Disk Report Widget Thresholds
	|===============================================
	|
	| Thresholds for disk report widget. This array holds two values:
	| free gigabytes below which the level is set to 'danger'
	| free gigabytes below which the level is set as 'warning'
	| If there are more free bytes, the level is set to 'success'
	|
	*/
	$conf['disk_thresholds'] = array('danger' => 5, 'warning' => 10);
	/*
	|===============================================
	| App settings
	|===============================================
	|
	| If the webapp is in a different directory as index.php, adjust
	| the variables below. For enhanced security it is advised to put the
	| webapp in a directory that is not visible to the internet.
	*/
	// Path to system folder, with trailing slash
	$conf['system_path'] = APP_ROOT.'/system/';
	// Path to app folder, with trailing slash
	$conf['application_path'] = APP_ROOT.'/app/';
	// Path to view directory, with trailing slash
	$conf['view_path'] = $conf['application_path'].'views/';
	// Path to controller directory, with trailing slash
	$conf['controller_path'] = $conf['application_path'].'controllers/';
	// Path to modules directory, with trailing slash
	$conf['module_path'] = $conf['application_path'] . "modules/";
	// Routes
	$conf['routes'] = array();
	$conf['routes']['module(/.*)?']	= "module/load$1";
	/*
	|===============================================
	| PDO Datasource
	|===============================================
	|
	| Specify dsn, username, password and options
	| Supported engines: sqlite and mysql
	| Mysql example:
	| 	$conf['pdo_dsn'] = 'mysql:host=localhost;dbname=munkireport';
	| 	$conf['pdo_user'] = 'munki';
	| 	$conf['pdo_pass'] = 'munki';
	| 	$conf['pdo_opts'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
	|
	*/
	$conf['pdo_dsn'] = 'sqlite:'.$conf['application_path'].'db/db.sqlite';
	$conf['pdo_user'] = '';
	$conf['pdo_pass'] = '';
	$conf['pdo_opts'] = array();
	/*
	|===============================================
	| Create table options
	|===============================================
	|
	| For MySQL, define the default table and charset
	|
	*/
	$conf['mysql_create_tbl_opts'] = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
	/*
	|===============================================
	| Timezone
	|===============================================
	|
	| See http://www.php.net/manual/en/timezones.php for valid values
	|
	*/
	$conf['timezone'] = @date_default_timezone_get();
	/*
	|===============================================
	| Custom css and js
	|===============================================
	|
	| If you want to override the default css or default js
	| you can specify a custom file that will be included
	| in the header (css) and footer (js)
	|
	*/
	//$conf['custom_css'] = '/custom.css';
	//$conf['custom_js'] = '/custom.js';
	/*
	|===============================================
	| Debugging
	|===============================================
	|
	| If set to TRUE, will deliver debugging messages in the page. Set to
	| FALSE in a production environment
	*/
	$conf['debug'] = FALSE;