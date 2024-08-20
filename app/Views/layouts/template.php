<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://cdn.tailwindcss.com"></script>


  <title><?= $title ?></title>
</head>
<body class="box-border min-h-screen">
  <div class="w-full sticky top-0 px-10 py-6 flex justify-between shadow-md bg-white">
    <h1 class="text-3xl font-extrabold text-red-600"><a href="<?= base_url(); ?>">Asad Kebab</a></h1>
    <div class="h-full">
      <?php if(session("isLoggedIn") && (session("role") == 1) || (session("role") == 2)): ?>
        <?php if(session("role") == 1):?>
          <a <?= current_url() === site_url('dashboard') ? 'style="color:red"' : 'href="'.base_url("dashboard").'"' ?>
            class="text-md font-semibold mx-5 my-3">
            Dashboard
          </a>
          <a <?= current_url() === site_url('purchases') ? 'style="color:red"' : 'href="'.base_url("purchases").'"' ?>
            class="text-md font-semibold mx-5 my-3">
            Purchases
          </a>
        <?php endif;?> 
        <a <?= current_url() === site_url('sellings') ? 'style="color:red"' : 'href="'.base_url("sellings").'"' ?>
          class="text-md font-semibold mx-5 my-3">
          Sellings
        </a>
        <a <?= current_url() === site_url('/') ? 'style="color:red"' : 'href="'.base_url().'"' ?>
          class="text-md font-semibold mx-5 my-3">Menus</a>
      <?php elseif(session("isLoggedIn") && (session("role") == 2 || session("role") == 1)): ?>
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
  <main class="p-10 bg-slate-100 min-h-screen">
    <?= $this->renderSection('content'); ?>
  </main>
  <footer class="bg-slate-800 text-white text-lg flex flex-col justify-center items-center p-5">
    <h3>Muhammad Asaduddin</h3>
    <h3>TI 4B</h3>
  </footer>
</body>
</html>