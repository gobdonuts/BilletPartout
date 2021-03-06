 <?php
    $_SERVER["basePath"] = '/';
    /* Author : Max-Antoine Clément
     * The client is always redirected to this page.
     * This page load essentials files and finaly load routes.php
     */
    session_start();
    //Autoload 
    spl_autoload_register(function ($class_name) {
        if (file_exists('./library/' . $class_name . '.php')) {
            require_once './library/' . $class_name . '.php';
        }
        if (file_exists('./models/' . $class_name . '.php')) {
            require_once './models/' . $class_name . '.php';
        }    
        if (file_exists('./controllers/' . $class_name . '.php')) {
            require_once './controllers/' . $class_name . '.php';
        } 
    });
    require_once('Routes.php');
    
?>