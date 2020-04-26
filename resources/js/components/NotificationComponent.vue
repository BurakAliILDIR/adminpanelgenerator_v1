<template>
  <section class="dropdown-menu aside-xl">
    <section class="panel bg-white">
      <header class="panel-heading b-light bg-light">
        <strong>You have <span class="count">2</span> notifications</strong>
      </header>
      <?php $auth_user = \Illuminate\Support\Facades\Auth::user(); ?>
      <div class="list-group list-group-alt animated fadeInRight">
        <a href="#" class="media list-group-item">
                  <span class="pull-left thumb-sm">
                    <img src="/admin-template/images/avatar.jpg" alt="Mikel"
                         class="img-circle">
                  </span>
          <span class="media-body block m-b-none">
                    Use awesome animate.css<br>
                    <small class="text-muted">10 minutes ago</small>
                  </span>
        </a>
        <a href="#" class="media list-group-item">
                  <span class="media-body block m-b-none">
                    1.0 initial released<br>
                    <small class="text-muted">1 hour ago</small>
                  </span>
        </a>
      </div>
      <footer class="panel-footer text-sm">
        <a href="#" class="pull-right"><i class="fa fa-cog"></i></a>
        <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
      </footer>
    </section>
  </section>
</template>
