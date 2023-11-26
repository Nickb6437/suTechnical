<?php 

/**
 * Initialisations
 * 
 * Register an autoloader, start or resume the session
 */
spl_autoload_register(function ($class) {

  require dirname(__DIR__) . "/classes/{$class}.php";
  
});

session_start();

// Load config
require  dirname(__DIR__) . '/config.php' ;

/**
 * Custom error handler function
 * 
 * @param int $level The error level
 * @param string $message The error message
 * @param string $file The file where the error occurred
 * @param int $line The line number where the error occurred
 * @throws ErrorException
 */
function errorHandler( $level, $message, $file, $line ) {

  throw new ErrorException( $message, 0, $level, $file, $line ) ;

}

/**
 * Exception Handler
 * 
 * Handles uncaught exceptions and displays error details if SHOW_ERR_DETAIL is true.
 * Otherwise, displays a generic error message.
 * 
 * @param Exception $exception The uncaught exception
 */
function exceptionHandler ( $exception ) {

  http_response_code(500);

  if ( SHOW_ERR_DETAIL ) {
    echo "<h1>An Error Occured</h1>" ;
    echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>" ;
    echo "<p>" . $exception->getMessage() . "</p>" ;
    echo "<p>Stack trace: <pre>" .$exception->getTraceAsString() . "</pre></p>" ;
    echo "<p>In File '" . $exception->getFile() . "' on line '" . $exception->getLine() . "'</p>" ;
  
  } else {

    echo "<h1>An Error Occured</h1>" ;
    echo "<p>Please try again later.</p>" ;

  }

  exit();

}

set_error_handler( 'errorHandler' ) ;
set_exception_handler( 'exceptionHandler' ) ; 