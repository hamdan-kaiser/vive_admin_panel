
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="profile-header">
                    <div class="cover">
                        <div class="gray-shade"></div>
                        <figure>
                            <img src="https://via.placeholder.com/1148x272" class="img-fluid" alt="profile cover">
                        </figure>
                        <div class="cover-body d-flex justify-content-between align-items-center">
                            <div>
                                <img class="profile-pic" src="{{$data->user->image}}" alt="profile">
                                <span class="profile-name">{{ $data->user->name ?? '' }}</span>
                            </div>
                            <div class="d-none d-md-block">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Update Status
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach(  $statuses as $status)
                                            <a class="dropdown-item" onclick="changeStatus({{$status->id}},{{$data->id}})">{{$status->title}}</a>
                                        @endforeach

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-6 ">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Course Type:</label>
                            <p class="text-muted">{{ucwords(str_replace('_',' ',$data->course_type))}}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Subject:</label>
                            <p class="text-muted">{{$data->subject->name ?? ''}}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">University:</label>
                            <p class="text-muted">{{$data->university->name ?? ''}}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">IELTS Score:</label>
                            <p class="text-muted">{{$data->ielts_score}}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Surname:</label>
                            <p class="text-muted">{{$data->surname}}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Given Name:</label>
                            <p class="text-muted">{{$data->given_name}}</p>
                        </div>


                    </div>
                </div>
            </div>
            <div class="d-none d-md-block col-md-6 ">
                <div class="card rounded">
                    <div class="card-body">

                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Email:</label>
                            <p class="text-muted">{{$data->email}}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Date Of Birth:</label>
                            <p class="text-muted">{{$data->date_of_birth}}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Address:</label>
                            <p class="text-muted">{{$data->address}}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Passport No:</label>
                            <p class="text-muted">{{$data->passport_no}}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Passport Expire:</label>
                            <p class="text-muted">{{$data->passport_expire}}</p>
                        </div>


                    </div>
                </div>
            </div>
            <!-- left wrapper end -->

        </div>
        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-12 mt-3">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase text-center">Passport Image:</label>
                            <p class="text-muted">
                                <img src="{{$data->passport_image}}">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


