<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Pico.css (Ini bisa diganti sesuai keinginan) -->
  <script src="https://cdn.tailwindcss.com"></script>


  <title><?= $title ?></title>
</head>
<body class="box-border">
  <div class="w-full sticky z-0 px-10 py-6 flex justify-between shadow-md">
    <h1 class="text-3xl font-extrabold text-red-600"><a href="<?= base_url(); ?>">Asad Kebab</a></h1>
    <div class="h-full">
      <?php if(session("isLoggedIn") && session("role") == 1): ?>
        <a <?= current_url() === site_url('dashboard') ? '' : 'href="'.base_url("dashboard").'"' ?>
          class="text-md font-semibold mx-5 my-3">
          Dashboard
        </a>
        <a <?= current_url() === site_url('transactions') ? '' : 'href="'.base_url("transactions").'"' ?>
          class="text-md font-semibold mx-5 my-3">
          Transactions
        </a>
        <a <?= current_url() === site_url() ? '' : 'href="'.base_url().'"' ?>
          class="text-md font-semibold mx-5 my-3">Menus</a>
      <?php endif;?>
      <a class="transition duration-500 px-6 py-3 rounded-full font-semibold
        <?php if(session("isLoggedIn")) :?>
          bg-red-300 hover:bg-red-600 hover:text-white text-pink-100" href="
          <?= base_url("logout")?>">
          Logout
        <?php else: ?>
          bg-blue-300 hover:bg-sky-600 hover:text-white text-sky-100" href="
          <?= base_url("login")?>">
          Login
        <?php endif;?>
    </a>
    </div>
  </div>
  <main class="p-10 bg-slate-100">
    <?= $this->renderSection('content'); ?>
  </main>
</body>
</html>