<header class="blog-header py-3">
   <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
         <a class="text-muted" href="#"></a>
      </div>
      <div class="col-4 text-center">
         <a class="blog-header-logo text-dark" href="/">Blog</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
         <?php if($this->request->session()->check('Auth.User')): ?>
            <span class="pr-3 text-capitalize">
               Bienvenido:
               <?= $this->request->session()->read('Auth.User.username') ?>
            </span>
            <a class="btn btn-sm btn-outline-secondary shadow-sm" href="/logout">
               Log out
            </a>
         <?php else: ?>
            <a class="btn btn-sm btn-outline-secondary shadow-sm" href="/login">Sign in</a>
         <?php endif; ?>
      </div>
   </div>
</header>
<div class="nav-scroller py-1 mb-2">
   <nav class="nav d-flex justify-content-between">
      <a class="p-2 text-muted" href="/">Home</a>
   </nav>
</div>
<div class="mb-4">
   <?= $this->Form->create(false, [
      'type' => 'get',
      'class' => 'form-inline',
      'url' => [
         'controller' => 'articles',
         'action' => 'index'
      ]
   ]) ?>
   <div class="col-10 col-md-11 p-0">
      <label class="sr-only" for="buscador">Buscar</label>
      <?= $this->Form->input('q', [
         'templates' => [
            'inputContainer' => '<div class="form-group mb-0">{{content}}</div>'
         ],
         'label' => false,
         'id' => 'buscador',
         'class' => 'form-control w-100 shadow-sm',
         'placeholder' => 'Buscar...',
         'value' => !empty($this->request->query) ? $this->request->getQuery('q') : ''
      ]) ?>
   </div>
   <div class="col-2 col-md-1 p-0">
      <button type="submit" class="btn btn-outline-primary w-100 shadow-sm" id="buscar">
         <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="16"></line>
         </svg>
      </button>
   </div>
   <?= $this->Form->end() ?>
</div>
<div class="jumbotron p-4 p-md-5 rounded">
   <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic">Primer blog</h1>
      <p class="lead my-3">Nuestro primer blog</p>
   </div>
</div>