<?php if(Session::has('error')): ?>
    <section style="background: #fff;margin-top:80px">
    <div class="alert alert-danger text-center" role="alert">
      <?php echo e(session::get('error')); ?>

    </div>
    </section>
<?php endif; ?>

<?php if(Session::has('success')): ?>

    <section style="background: #fff;margin-top:80px">
            <div class="alert alert-success text-center" role="alert">
                <?php echo e(session::get('success')); ?></div>

    </section>
<?php endif; ?>
