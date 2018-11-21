<?php

define('COCKPIT_INSTALL', true);

$sqlitesupport = false;

// check whether sqlite is supported
try {

    if (extension_loaded('pdo')) {
        $test = new PDO('sqlite::memory:');
        $sqlitesupport = true;
    }

} catch (Exception $e) { }

// require(__DIR__.'/../bootstrap.php');
require(__DIR__.'/../monoplane/monoplane.php');

// misc checks
$checks = array(
    'Php version >= 7.1.0'                              => (version_compare(PHP_VERSION, '7.1.0') >= 0),
    'Missing PDO extension with Sqlite support'         => $sqlitesupport,
    'GD extension not available'                        => extension_loaded('gd'),
    'MBString extension not available'                  => extension_loaded('mbstring'),
    'Data  folder is not writable: /storage/data'       => is_writable(COCKPIT_STORAGE_FOLDER.'/data'),
    'Cache folder is not writable: /storage/cache'      => is_writable(COCKPIT_STORAGE_FOLDER.'/cache'),
    'Temp folder is not writable: /storage/tmp'         => is_writable(COCKPIT_STORAGE_FOLDER.'/tmp'),
    'Uploads folder is not writable: /storage/uploads'  => is_writable(COCKPIT_STORAGE_FOLDER.'/uploads'),
);

$failed = [];

foreach($checks as $info => $check) {

    if (!$check) {
        $failed[] = $info;
    }
}

if (!count($failed)) {

    $app = cockpit();

    // check whether cockpit is already installed
    // try {

        // if ($app->storage->getCollection('cockpit/accounts')->count()) {
            // header('Location: '.$app->baseUrl('/'));
            // exit;
        // }

    // } catch(Exception $e) { }
/* 
    $created = time();

    $account = [
        'user'     => 'admin',
        'name'     => 'Admin',
        'email'    => 'admin@yourdomain.de',
        'active'   => true,
        'group'    => 'admin',
        'password' => $app->hash('admin'),
        'i18n'     => 'en',
        '_created' => $created,
        '_modified'=> $created,
    ];

    $app->storage->insert("cockpit/accounts", $account);
 */
    
    // install monoplane dummy data
    
    
}

if (PHP_SAPI === 'cli') {

    if(count($failed)) {
        foreach ($failed as $info) {
            echo "$info\r\n";
        }
        exit(1);
    } else {
        // echo "Login Credentials: admin / admin\r\n";
        // echo "Please change the login information after your first login\r\n";
        // echo "into the system for obvious security reasons.\r\n";
        exit(0);
    }

    

} else {

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>System installation</title>
</head>
<body>
  <?php if(count($failed)): ?>

    <h1>Installation failed</h1>

      <?php foreach ($failed as &$info): ?>
        <p><?php echo @$info;?></p>
      <?php endforeach; ?>

    <p><a href="?<?php echo time();?>">Retry installation</a></p>

  <?php else: ?>

    <!--<h1>Installation completed</h1>

    <p>Login Credentials: admin / admin</p>

    <p>Please change the login information after your first login into the system for obvious security reasons.</p>

    <p><a href="<?php echo $app->route(COCKPIT_BASE_URL);?>">Login now</a></p>-->
    
    <p>All dependency checks passed. Yeah! :-)</p>
    <p>Installation via PHP/Browser is not possible. Use the CLI instead.</p>

  <?php endif; ?>
</body>
</html>
<?php } // end of if(PHP_SAPI...) ?>
