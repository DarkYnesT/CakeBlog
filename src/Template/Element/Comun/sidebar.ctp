<div class="p-4 mb-3 bg-light rounded">
   <h4 class="font-italic">About</h4>
   <p class="mb-0">Prueba de creacion de un blog con cakephp 3</p>
</div>
<div class="p-4">
   <h4 class="font-italic">Articles</h4>
   <ol class="list-unstyled mb-0">
      <?php foreach ($allArticles as $article): ?>
         <li><a href="/blog/articulo/<?= $article->id ?>"><?= $article->title ?></a></li>
      <?php endforeach; ?>
   </ol>
</div>