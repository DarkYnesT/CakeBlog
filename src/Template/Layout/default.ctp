<!DOCTYPE html>
<html lang="es">
<head>
   <?= $this->Html->charset() ?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>
      Blog:
      <?= $this->fetch('title') ?>
   </title>
   <?= $this->Html->meta('icon') ?>

   <?= $this->Html->css('lib/bootstrap.css') ?>
   <?= $this->Html->css('custom.css') ?>

   <?= $this->Html->css('//fonts.googleapis.com/css?family=Playfair+Display:700,900') ?>

   <?= $this->fetch('meta') ?>
   <?= $this->fetch('css') ?>
   <?= $this->fetch('script') ?>
</head>
<body>
   <div class="container">
      <?= $this->element('Comun/Header') ?>
   </div>
   <div class="container">
      <?= $this->Flash->render() ?>
      <div class="row">
         <div class="col-md-8 blog-main">
            <?= $this->fetch('content') ?>
         </div>
         <aside class="col-md-4 blog-sidebar">
            <?= $this->element('Comun/sidebar') ?>
         </aside>
      </div>
   </div>
   <footer class="blog-footer">
      <p>Blog template built with <a href="https://getbootstrap.com/">Bootstrap</a></p>
      <p>
         <a href="#" id="top">Back to top</a>
      </p>
   </footer>
   <?= $this->Html->script('lib/jquery-3.3.1.min.js') ?>
   <?= $this->Html->script('lib/popper.min.js') ?>
   <?= $this->Html->script('lib/bootstrap.min.js') ?>
   <?= $this->Html->script('custom.js') ?>
</body>
</html>
