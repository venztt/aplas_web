<div class="btn-group">
    @if(in_array('edit', $enabledCruds))
        <a class="btn btn-success mr-1" href="{{ route($crudRoutePart . '.edit', $row->id) }}">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endif
    @if(in_array('show', $enabledCruds))
        <a class="btn btn-warning mr-1" href="{{ route($crudRoutePart . '.show', $row->id) }}">
            <i class="fa fa-eye"></i>
        </a>
    @endif
    @if(in_array('delete', $enabledCruds))
        <form action="{{ route($crudRoutePart . '.destroy', $row->id) }}" method="POST"
              onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-danger mr-1">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    @endif
</div>
