<?= $this->extend('./layouts/auth'); ?>
<?php $title = 'Login';?>

<?= $this->section('content'); ?>

<article class="relative bg-white flex flex-col rounded-xl justify-center align-center text-lg py-20 px-10 w-1/2">
  <a href="<?= base_url()?>" class="absolute top-5 right-5">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
    </svg>
  </a>
  <h2 class="text-center font-bold text-2xl mb-10">Login</h2>

  <p class="text-red-600 text-center">
    <?php
    if(session()->getFlashData('msg')){
      echo session()->getFlashData('msg');
    }
    ?>
  </p>

  <form action="login/auth" method="post" 
        class="flex flex-col text-lg items-center justify-center w-full">
    <input type="email" name="email" id="email" placeholder="Email" 
          class="placeholder:italic text-center my-2 w-3/4 bg-white border border-slate-300 p-2 rounded-lg focus:outline-sky-400">
    <input type="password" name="password" id="password" placeholder="password" 
          class="placeholder:italic text-center my-2 w-3/4 bg-white border border-slate-300 p-2 rounded-lg focus:outline-sky-400">
    <button class="my-10 py-3 px-10 bg-red-400 rounded-full text-orange-100 hover:text-white hover:bg-red-800 transition duration-300 font-semibold">
      Login
    </button>
  </form>
  
  <p class="text-center">Don't have account ? <a class="text-blue-700" href="<?= base_url('register') ?>">Register</a></p>
</article>

<?= $this->endSection() ?>