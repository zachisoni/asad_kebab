<?= $this->extend('./layouts/auth'); ?>

<?= $this->section('content'); ?>

<article 
  class="relative bg-white flex flex-col rounded-xl justify-center align-center text-lg py-20 px-4 w-1/2 shadow-lg">
  <a href="<?= base_url('login')?>" class="absolute top-5 right-5">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
    </svg>
  </a>
  <h2 class="text-center font-bold text-2xl mb-10">Register</h2>

  <form action="<?= base_url('register/store') ?>" method="POST"
        class="flex flex-col text-lg items-center justify-center w-full text-left">
    <label for="username" class="w-5/6 flex justify-between items-center">
      Username
      <input type="text" name="username" id="username" placeholder="Username"
        class="placeholder:italic text-left my-2 w-3/4 bg-white border border-slate-300 p-2 rounded-lg focus:outline-sky-400">
    </label>
    <?php if(null != validation_show_error('username')) :?>  
      <p class="text-red-600 italic text-left mb-4"><?= validation_show_error('username'); ?></p>
    <?php endif;?>
    
    <label for="email" class="w-5/6 flex justify-between items-center">
      Email
      <input type="email" name="email" id="email" placeholder="Email"
        class="placeholder:italic text-left my-2 w-3/4 bg-white border border-slate-300 p-2 rounded-lg focus:outline-sky-400">
    </label>
    <?php if(null != validation_show_error('email')) :?>  
      <p class="text-red-600 italic text-left mb-4"><?= validation_show_error('email'); ?></p>
    <?php endif;?>

    <label for="password" class="w-5/6 flex justify-between items-center">
      Password
      <input type="password" name="password" id="password" placeholder="Password"
      class="placeholder:italic text-left my-2 w-3/4 bg-white border border-slate-300 p-2 rounded-lg focus:outline-sky-400">
    </label>
    <?php if(null != validation_show_error('password')) :?>  
      <p class="text-red-600 italic text-left mb-4"><?= validation_show_error('password'); ?></p>
    <?php endif;?>

    <label for="passconf" class="w-5/6 flex justify-between items-center">
      Confirm Password
      <input type="password" name="passconf" id="passconf" placeholder="Confirm Password"
      class="placeholder:italic text-left my-2 w-5/6 bg-white border border-slate-300 p-2 rounded-lg focus:outline-sky-400">
    </label>
    <?php if(null != validation_show_error('passconf')) :?>  
      <p class="text-red-600 italic text-left mb-4"><?= validation_show_error('passconf'); ?></p>
    <?php endif;?>

    <button value="submit" 
      class="my-10 py-3 px-10 bg-blue-300 rounded-full text-sky-100 w-2/5 hover:text-white hover:bg-sky-600 transition duration-300 font-semibold">Submit</button>
  </form>

  <p class="text-center">Have an account already? <a class="text-blue-700" href="<?= base_url('login') ?>">Login</a></p>
</article>

<?= $this->endSection() ?>