<?php 

class Users {

  /**
   * Retrieves users and their associated orders from the database.
   *
   * @param PDO $conn The database connection object.
   * @return array An array of users with their associated orders.
   */
  public static function getUsers($conn) {
    $sql = "SELECT users.*, orders.*
    FROM users
    LEFT JOIN orders
    ON users.id = orders.userid
    ORDER BY users.id DESC";

    $results = $conn->query($sql);

    $users = [];

    foreach ($results->fetchAll(PDO::FETCH_ASSOC) as $row) {
      $userId = $row['userId'];
      $orderId = $row['id'];
      // loop $users arry and restructure it to include orders
      if (!isset($users[$userId])) {
          $users[$userId] = [
              'id' => $userId,
              'username' => $row['username'],
              'password' => $row['password'],
              'email' => $row['email'],
              'firstName' => $row['firstName'],
              'lastName' => $row['lastName'],
              'orders' => [],
          ];
      }
      $users[$userId]['orders'][] = [
          'orderId' => $orderId,
          'orderDate' => $row['orderDate'],
          'totalAmount' => $row['totalAmount'],
          'status' => $row['status'],
      ];
    }

    return $users;
  }
}
