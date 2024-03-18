<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PT Gentala Bumi Nusantara | <?= $title ?></title>
  <link rel="icon" href="assets/icons/favicon.ico" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="assets/css/custom.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/vendor/slick-1.8.1/slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="assets/vendor/slick-1.8.1/slick/slick.theme.css" />

  <style>
    .active {
      font-weight: bold;
      /* background-color: #F8BB02; */
      color: #0E035C;
    }
  </style>


</head>
<nav class="bg-white dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto">
    <a href="<?= base_url(); ?>" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="assets/images/logo.png" class="flex-shrink-0 bg-cover bg-no-repeat bg-center" alt="Gentala Logo">
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
      </svg>
    </button>

    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul style="font-family: Outfit;" class="flex flex-col items-center p-4 md:p-0 mt-6 font-normal border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="<?= base_url(); ?>" class="block py-2 px-3 text-[#252525] rounded md:hover:bg-transparent md:border-0 md:hover:text-[#0E035C] md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent <?php echo $active == 'homepage' ? 'active' : ''; ?>">Home</a>
        </li>
        <li>
          <a href="<?= base_url('services'); ?>" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[#0E035C] md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent <?php echo $active == 'services' ? 'active' : ''; ?>">Services</a>
        </li>
        <li>
          <a href="<?= base_url('project'); ?>" class="block py-2 px-3 text-[#252525] rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[#0E035C] md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent <?php echo $active == 'project' ? 'active' : ''; ?>">Projects</a>
        </li>
        <li>
          <a href="<?= base_url('news'); ?>" class="block py-2 px-3 text-[#252525] rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[#0E035C] md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent <?php echo $active == 'news' ? 'active' : ''; ?>">News</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-[#252525] rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[#0E035C] md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About Us</a>
        </li>
        <li class="inline-block mt-4 md:mt-0">
          <a href="#">
            <button type="button" style="background-color: var(--Premier-Color-Light, #F8BB02);" class="inline-flex items-center text-black w-36 h-9 rounded-2xl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              <img src="assets/icons/whatsapp.png" alt="WhatsApp" class="w-5 h-5 mr-2">
              Contact Us
            </button>
          </a>
        </li>
      </ul>
    </div>

  </div>
</nav>