<div class="mb-3">
   <h2 class="blog-post-title mb-3">Article</h2>

   <?= $this->Form->create($article); ?>

   <div class="form-group">
      <label for="title" class="sr-only">Title</label>
      <?= $this->Form->input('title', [
         'label' => false,
         'class' => 'form-control f-2 shadow-sm',
         'placeholder' => 'Title'
      ]); ?>
   </div>
   <div class="form-group">
      <label for="body" class="sr-only">Body</label>
      <?= $this->Form->input('body', [
         'rows' => '6',
         'label' => false,
         'class' => 'form-control f-2 shadow-sm',
         'placeholder' => 'Body'
      ]); ?>
   </div>
   <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm">Guardar</button>
   <a href="<?= $referer ?>" class="btn btn-sm btn-outline-secondary shadow-sm">Cancelar</a>

   <?= $this->Form->end(); ?>
</div>
