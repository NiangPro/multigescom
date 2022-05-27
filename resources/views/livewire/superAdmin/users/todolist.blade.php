<div class="col-lg-4 col-md-12 col-12 col-sm-12">
    <div class="card">
      <div class="card-header">
        @if ($todo === 'add')
        <h4>Ajout</h4>
        <button type="button" wire:click.prevent="formadd" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>

        @else
        <h4>A Faire</h4>
        <button type="button" wire:click.prevent="backTodo" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i></button>

        @endif

      </div>
      <div class="card-body">
          @if ($todo === 'add')
            <form wire:submit.prevent="addTodo">
                <div class="form-group">
                <label for="">Titre</label>
                <input type="text" class="form-control" placeholder="">
                </div>
            </form>
          @else
            <ul class="list-unstyled list-unstyled-border">
                <li class="media">
                    <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-1.png" alt="avatar">
                    <div class="media-body">
                    <div class="float-right text-primary">Now</div>
                    <div class="media-title">Farhan A Mujib</div>
                    <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                    </div>
                </li>
            </ul>
            <div class="text-center pt-1 pb-1">
            <a href="#" class="btn btn-primary btn-lg btn-round">
                voir plus
            </a>
            </div>

            @endif
      </div>
    </div>
</div>
