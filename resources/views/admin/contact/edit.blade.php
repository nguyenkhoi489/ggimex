@extends('admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline p-4">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                           name="title"
                                           readonly
                                           value="{{ $contact->title }}"
                                           class="form-control" placeholder="Name ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email"
                                           name="email"
                                           readonly
                                           value="{{ $contact->email }}"
                                           class="form-control" placeholder="email ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Message</label>
                                <div class="col-sm-8">
                                        <textarea name="message" readonly
                                                  class="form-control">{{ $contact->message  }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Link</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                           name="link"
                                           readonly
                                           value="{{$contact->link}}"
                                           class="form-control" placeholder="email ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="{{ route('contact.index') }}"
                                       class="btn btn-default"
                                       data-dismiss="modal">Trở
                                        về</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
