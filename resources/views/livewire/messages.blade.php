<div>
    <div class="row align-items-center justify-content-center">
        <div class="col-12 col-sm-6 col-lg-4">
          <div class="card">
            <div class="card-header">
                {{-- <h4>Who's Online?</h4> --}}
                <select class="form-control">
                    <option value="">Recherche personne</option>
                    @foreach ($users as $user)
                      <option default value="{{ $user->id }}">{{ $user->prenom }} {{ $user->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="card-body">
              <ul class="list-unstyled list-unstyled-border">
                {{-- <li class="media">
                  <img alt="image" class="mr-3 rounded-circle" width="50" src="../../storage/images/avatar/avatar-1.png">
                  <div class="media-body">
                    <div class="mt-0 mb-1 font-weight-bold">{{ $current_user->prenom }} {{ $current_user->nom }}</div>
                    <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Online</div>
                  </div>
                </li> --}}
                <li class="media">
                  <img alt="image" class="mr-3 rounded-circle" width="50" src="../../storage/images/avatar/avatar-2.png">
                  <div class="media-body">
                    <div class="mt-0 mb-1 font-weight-bold">Bagus Dwi Cahya</div>
                    <div class="text-small font-weight-600 text-muted"><i class="fas fa-circle"></i> Offline</div>
                  </div>
                </li>
                <li class="media">
                  <img alt="image" class="mr-3 rounded-circle" width="50" src="../../storage/images/avatar/avatar-3.png">
                  <div class="media-body">
                    <div class="mt-0 mb-1 font-weight-bold">Wildan Ahdian</div>
                    <div class="text-small font-weight-600 text-success"><i class="fas fa-circle"></i> Online</div>
                  </div>
                </li>
                <li class="media">
                  <img alt="image" class="mr-3 rounded-circle" width="50" src="../../storage/images/avatar/avatar-4.png">
                  <div class="media-body">
                    <div class="mt-0 mb-1 font-weight-bold">Rizal Fakhri</div>
                    <div class="text-small font-weight-600 text-success"><i class="fas fa-circle"></i> Online</div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-8 mt-0">
          <div class="card chat-box" id="mychatbox">
            <div class="card-header">
              <h4>Discussion</h4>
            </div>
            <div class="card-body chat-content" style="background-image:url('../../storage/images/chat-box.png'); 
            background-repeat: ROUND; height: 100%; width:100%; position: relative; ">
                <div class="chat-item chat-left" >
                    <img src="{{asset('storage/images/'.Auth()->user()->profil)}}">
                    <div class="chat-details">
                        <div class="chat-text" style="vertical-align: inherit;">
                            Salut mec!
                        </div>
                        <div class="chat-time" style="vertical-align: inherit;">
                           04:01
                        </div>
                    </div>
                </div>
                <div class="chat-item chat-right" style="">
                    <img src="{{asset('storage/images/'.Auth()->user()->profil)}}">
                    <div class="chat-details">
                        <div class="chat-text" style="vertical-align: inherit;">
                            Quoi&nbsp;?
                        </div>
                        <div class="chat-time" style="vertical-align: inherit;">
                            04:01
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer chat-form">
              <form id="chat-form">
                <input type="text" class="form-control" placeholder="Type a message">
                <button class="btn btn-primary">
                  <i class="far fa-paper-plane"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
</div>
