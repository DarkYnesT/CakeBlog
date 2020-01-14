<div class="blog-post">
   <div class="pb-4 mb-4 border-bottom">
      <?= $this->Html->link("Añadir artículo",
         ['action' => 'add'],
         ['class' => 'btn btn-sm btn-outline-secondary shadow-sm']
      ) ?>
   </div>
   <div class="mb-2">
      <?php if (!empty($this->request->query['q'])): ?>
         <?= $this->Html->link("Limpiar Busqueda",
            ['action' => 'index'],
            ['class' => 'btn btn-sm btn-outline-warning shadow-sm']
         ) ?>
      <?php endif; ?>
   </div>
   <?php foreach ($articles as $article): ?>
   <div class="mb-3">
      <h2 class="blog-post-title">
         <a href="/blog/articulo/<?= $article->id ?>" class="text-decoration-none text-dark">
            <?= $article->title ?>
         </a>
      </h2>
      <p class="blog-post-meta">
         <?= $article->created->format('F n, Y') ?> by
         <span class="text-capitalize"><?= $article->user->username ?></span>
      </p>
      <p><?= str_replace(array("\r\n", "\n\r", "\r", "\n"), "<br />", $article->body) ?></p>
      <?php if ($login) : ?>
         <?php if (($article->user_id == $this->request->session()->read('Auth.User.id')) || (
            $this->request->session()->read('Auth.User.role') == 'admin')): ?>
            <div>
               <?= $this->Html->link('Editar',
                  ['action' => 'edit', $article->id],
                  ['class' => 'btn btn-sm btn-outline-info shadow-sm']
               ) ?>
               <?= $this->Form->postLink('Eliminar',
                  ['action' => 'delete', $article->id],
                  [
                     'confirm' => '¿Estás seguro?',
                     'class' => 'btn btn-sm btn-outline-danger shadow-sm'
                  ]
               ) ?>
            </div>
         <?php endif; ?>
      <?php endif; ?>
   </div>
   <?php endforeach; ?>
   <?= $this->element('Comun/pagination') ?>
</div>