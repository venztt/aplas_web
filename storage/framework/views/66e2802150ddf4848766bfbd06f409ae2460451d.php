<div class="btn-group">
    <?php if(in_array('edit', $enabledCruds)): ?>
        <a class="btn btn-success mr-1" href="<?php echo e(route($crudRoutePart . '.edit', $row->id)); ?>">
            <i class="fa fa-pencil-alt"></i>
        </a>
    <?php endif; ?>
    <?php if(in_array('show', $enabledCruds)): ?>
        <a class="btn btn-warning mr-1" href="<?php echo e(route($crudRoutePart . '.show', $row->id)); ?>">
            <i class="fa fa-eye"></i>
        </a>
    <?php endif; ?>
    <?php if(in_array('delete', $enabledCruds)): ?>
        <form action="<?php echo e(route($crudRoutePart . '.destroy', $row->id)); ?>" method="POST"
              onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <button type="submit" class="btn btn-danger mr-1">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    <?php endif; ?>
</div>
<?php /**PATH D:\Kuliah\Skripsi\code\resources\views/partials/datatableActions.blade.php ENDPATH**/ ?>