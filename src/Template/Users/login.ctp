<?= $this->Html->css('signform') ?>
<?= $this->Form->create($user, ['class' => 'form-signin']) ?>
<?= $this->Flash->render() ?>
<div class="text-center mb-4">
   <h1 class="h3 mb-3 font-weight-normal">Entrar</h1>
</div>
<div class="text-center mb-3">
   <a href="/" class="btn btn-sm btn-link">Volver al blog</a>
</div>
<div class="form-group">
   <label for="username" class="sr-only">Username</label>
   <?= $this->Form->input('username', [
      'label' => false,
      'class' => 'form-control f-2 shadow-sm',
      'placeholder' => 'Username'
   ]) ?>
</div>
<div class="form-group">
   <label for="password" class="sr-only">Password</label>
   <?= $this->Form->input('password', [
      'label' => false,
      'class' => 'form-control f-2 shadow-sm',
      'placeholder' => 'Password'
   ]) ?>
</div>
<button class="btn btn-lg btn-primary btn-block shadow-sm" type="submit">Sign in</button>
<div class="mt-3 text-center">
   <p>¿Aun no tienes una cuenta? <a href="/register">Registrate</a></p>
</div>
<?= $this->Form->end() ?>