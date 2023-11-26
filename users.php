<?php 
  require 'includes/header.php';

  require 'includes/init.php';

  $conn = require 'includes/db.php';

  $users = Users::getUsers($conn);

?>

  <section class="su-user-list">
    <div class="mb-6 lg:mb-0">
      <h1 class="text-3xl mb-6">Users Table</h1>
      <p class="max-w-prose">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint neque, amet impedit animi perferendis officiis a minus excepturi necessitatibus ea assumenda perspiciatis, aliquam ex repellendus natus delectus voluptatibus error iure.
        Adipisci, sequi! Dolore, cupiditate minus! Unde, consequuntur eum beatae quis perspiciatis porro nesciunt nam! Veniam assumenda, mollitia minima earum, repellat quam, quasi voluptatibus quis ut recusandae corrupti exercitationem suscipit non.
      </p>
    </div>

    <?php if ( !empty($users) ) : ?>
      <table class="su-user-list__table">
        <thead>
            <tr class="su-user-list__table-head-row">
                <th>User</th>
                <th>Order ID</th>
                <th>Status</th>
                <th>Order Total</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
            <?php $rows = count($user['orders']); ?>
              <tr class="su-user-list__table-body-row">
                <td rowspan="<?= $rows ?>">
                    <ul class="pr-2">
                        <li><?= $user['firstName'] . ' ' . $user['lastName'] ?></li>
                        <li><?= $user['email'] ?></li>
                    </ul>
                </td>
                <?php foreach ($user['orders'] as $index => $order) : ?>
                  <?php if ($rows >1) : ?>
                      <tr class="su-user-list__table-body-row__orders">
                    <?php endif; ?>
                    <?php if ($index > 0) : ?>
                      <td></td>
                    <?php endif; ?>
                    <td><?= $order['orderId'] ?></td>
                    <td><?= $order['status'] ?></td>
                    <td><?= $order['totalAmount'] ? '£' . number_format($order['totalAmount'], 2) : '' ?></td>
                    <td><?= $order['orderDate'] ? (new DateTime($order['orderDate']))->format('d/m/Y') : '' ?></td>
                    <?php if ($rows > 0) : ?>
                      </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
      </table>
    <?php else : ?> 
      <p> No users found. </p>
    <?php endif; ?>
  </section>

<?php 
  require 'includes/footer.php';
?>