<?php 
  require 'includes/header.php';

  require 'includes/init.php';

  $conn = require 'includes/db.php';

  $errors = [];
  $sent = false;
  $fname = $_POST['fname'] ?? '';
  $lname = $_POST['lname'] ?? '';
  $email = $_POST['email'] ?? '';
  $message = $_POST['message'] ?? '';

  if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    $contact = new Contact();
    $contact->fname = htmlspecialchars($fname);
    $contact->lname = htmlspecialchars($lname);
    $contact->email = htmlspecialchars($email);
    $contact->message = htmlspecialchars($message);

    $response = $contact->validate();

    $errors = $response['errors'];

    if ( empty($errors) ) {
      $sent = $contact->submit($conn);

      $fname = '';
      $lname = '';
      $email = '';
      $message = '';
    }
  }
?>
  <section class="su-contact">
    <div class="su-contact-content lg:w-1/2">
      <h1 class="text-3xl mb-6">SUSU Technical</h1>
      <h4 class="max-w-prose text-lg/snug font-medium mb-4">
        Use the form to contact us. </br>
        We look forward to hearing from you.
      </h4>
      <p class="max-w-prose">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint neque, amet impedit animi perferendis officiis a minus excepturi necessitatibus ea assumenda perspiciatis, aliquam ex repellendus natus delectus voluptatibus error iure.
        Adipisci, sequi! Dolore, cupiditate minus! Unde, consequuntur eum beatae quis perspiciatis porro nesciunt nam! Veniam assumenda, mollitia minima earum, repellat quam, quasi voluptatibus quis ut recusandae corrupti exercitationem suscipit non.
      </p>
    </div>

    <div class="w-full lg:w-1/2">
      <?php if ( $sent ) : ?> 
        <div class="bg-green-300 border border-green-900 su-contact__toast">
          <p class="text-green-900 p-3">Message Sent.</p>
          <span class="sr-only">Message Sent</span>
          <div class="bg-green-900 su-contact__toast-icon">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" class="fill-gray-100"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
          </div>
        </div>
      <?php elseif ( !empty($errors)) : ?>
        <div class="bg-red-300 border border-red-900 su-contact__toast">
          <ul class="p-3">
            <?php foreach ($errors as $error) : ?>
              <li class="text-red-900">
                <?= $error ?>
                <span class="sr-only">
                  <?= $error ?>
                </span>
              </li>
            <?php endforeach; ?>
          </ul>
          <div class="bg-red-900 su-contact__toast-icon">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="fill-gray-100"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>
          </div>
        </div>
      <?php endif; ?>

      <form 
        action="index.php"
        method="post"
        class="su-contact-form"
      >
        <fieldset class="su-contact-form__feildset">
          <div class="su-contact-form__feildset-feild">
            <label for="fname">
              First Name *
            </label>
            <input 
              type="text" 
              id="fname" 
              name="fname" 
              placeholder="Your name.."
              value="<?= $fname ?>"
              aria-required="true"
            >
          </div>
          <div class="su-contact-form__feildset-feild">
            <label for="lname">
              Last Name *
            </label>
            <input 
              type="text" 
              id="lname" 
              name="lname" 
              placeholder="Your last name.."
              value="<?= $lname ?>"
              aria-required="true"
            >
          </div>
          <div class="su-contact-form__feildset-feild">
            <label for="email">
              Email Address *
            </label>
            <input 
              type="text" 
              id="email" 
              name="email" 
              placeholder="Your email address.." 
              value="<?= $email ?>"
              aria-required="true"
            >
          </div>
          <div class="su-contact-form__feildset-feild">
            <label for="message">
              Message *
            </label>
            <textarea
              id="message" 
              name="message" 
              placeholder="Write something.." 
              cols="30"
              rows="5"
              aria-required="true"
            ><?= $message ?? null ?></textarea>
          </div>
          <span class="su-contact-form__feildset-required text-xs text-right w-full">
            * Required
        </fieldset>
        <button 
          type="submit" 
          value="Submit"
          class="su-contact-form__submit"
        >
          <span class="sr-only">Submit contact form</span>
          Submit
        </button>
      </form>
    </div>
  </section>


<?php 
  require 'includes/footer.php';
?>