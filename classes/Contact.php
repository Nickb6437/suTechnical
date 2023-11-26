<?php

  /**
   * Contact form class
   * 
   * @package Contact Form
   * @version 1.0.0
   * @since 1.0.0
   */
  class Contact {

    /**
    * Contact form first name
    * 
    * @var string
    */
    public $fname;

    /**
     * Contact form last name
     * 
     * @var string
     */
    public $lname;

    /**
     * Contact form email
     * 
     * @var string
     */
    public $email;

    /**
     * Contact form message
     * 
     * @var string
     */
    public $message;

    /**
     * Contact form errors
     * 
     * @var array
     */
    public $errors = [];

    /**
     * Contact form constructor
     * checks if contact table exists and creates it if it doesn't
     * 
     * @return void
     */
    public function __construct() {
      $sql = "CREATE TABLE IF NOT EXISTS contact (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(30) NOT NULL,
        lname VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      )";

      $db = require './includes/db.php';
      $stmt= $db->prepare($sql);
      $stmt->execute();
    }


    /**
     * Validates the contact form data.
     *
     * Checks if the first name, last name, email, and message fields are filled out correctly.
     * If any of the fields are missing or the email is invalid, corresponding error messages are added to the errors array.
     *
     * @return array An array containing the errors, if any.
     */
    public function validate() {
      if ( !$this->fname ) {
        $this->errors[] = 'First name is required';
      }
  
      if ( !$this->lname ) {
        $this->errors[] = 'Last name is required';
      }
  
      if ( !$this->email ) {
        $this->errors[] = 'Email is required';
      } else if ( !filter_var($this->email, FILTER_VALIDATE_EMAIL) ) {
        $this->errors[] = 'Email is invalid';
      }
  
      if ( !$this->message ) {
        $this->errors[] = 'Message is required';
      }

      $response = [
        'errors' => $this->errors ?? null,
      ];

      return $response;
    }

    /**
     * Contact form submit
     * 
     * @return void
     */
    public function submit($conn) {
      $sql = "INSERT INTO contact (fname, lname, email, message) VALUES (:fname, :lname, :email, :message)";

      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':fname', $this->fname, PDO::PARAM_STR);
      $stmt->bindParam(':lname', $this->lname, PDO::PARAM_STR);
      $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
      $stmt->bindParam(':message', $this->message, PDO::PARAM_STR);

      if ($stmt->execute()) {
        return true;
      } else {
        return false;
      }
    }
  }