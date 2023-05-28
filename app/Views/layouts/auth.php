<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Pico CSS -->
  <!-- <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css"> -->
  <script src="https://cdn.tailwindcss.com"></script>

  <title><?= current_url() === site_url('login') ? 'Login' : 'Register';?></title>
</head>
<body>
  <!-- <div class="bg-red-600 p-6 flex justify-center w-screen">
    <h1 class="text-2xl text-white font-extrabold">Farhan Kebab</h1>
  </div> -->
  <main class="px-5 py-20 bg-orange-100 flex items-center justify-center flex-col">
    <?= $this->renderSection('content'); ?>
  </main>
</body>
</html>