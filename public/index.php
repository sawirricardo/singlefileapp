<?php
// 1. uncomment if you want to turn on your error
// error_reporting(E_ALL);

// 2. define your ABSPATH here. It's your choice you want to place this in root or in a 'public' folder
// this assume you put index.php in your public folder
define('ABSPATH', dirname(__DIR__));

// ucomment if you use composer/3rd party vendor
// include_once join(DIRECTORY_SEPARATOR, [ABSPATH, 'vendor', 'autoload.php']);

// you can include other files here if you want

run_app();
/**
 * Main App process happening here
 * @author Ricardo <sawir.ricardo@gmail.com>
 *
 * @return void
 */
function run_app()
{
    //you can also initialize session here
    $arr_route = (explode('/', ltrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/')));
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if ($arr_route[0] == '') {
            // handle index here
            controller_get_index();
        } elseif ($arr_route[0] == 'assets') {
            controller_get_assets();
        } else {
            controller_get_404();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
// handle your post request here
    }
    // if you want to include other request method like DELETE/PUT/PATH
}

function controller_get_404()
{
    // handle view
    echo render_header();
    echo render_footer();
}

function controller_get_assets()
{
    $arr_route = explode('/', ltrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
    unset($arr_route[0], $arr_route[1]);
    $str_path = join(DIRECTORY_SEPARATOR, $arr_route);
    $name     = join(DIRECTORY_SEPARATOR, [ABSPATH, 'public', 'assets', $str_path]);
    $fp       = fopen($name, 'rb');
// send the right headers
    header("Content-Type: image/png");
    header("Content-Length: " . filesize($name));
// dump the picture and stop the script
    fpassthru($fp);
    exit;
}

function controller_get_index()
{
// handle view
    echo render_header();
    // I name this render_index just to follow the name convention. If your controller is controller_get_random_name, then I suggest you name render_random_name. Just to make things more easy to organize later.
    echo render_index();
    echo render_footer();

}

function render_index()
{
    ob_start();?>
<main></main>
<?php return ob_get_clean();
}

function render_header()
{
    ob_start();?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>

  <body>
    <?php return ob_get_clean();
}

function render_footer()
{
    ob_start();?>
  </body>

</html>
<?php return ob_get_clean();
}