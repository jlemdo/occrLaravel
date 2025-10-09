
 <div class="pb-5">
         <!-- resources/views/initiate-call.blade.php -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Initiate Call</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('initiate-call') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="from_number" class="col-md-4 col-form-label text-md-right">From Number:</label>

                                <div class="col-md-6">
                                    <input id="from_number" type="text" class="form-control" name="from_number" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="to_number" class="col-md-4 col-form-label text-md-right">To Number:</label>

                                <div class="col-md-6">
                                    <input id="to_number" type="text" class="form-control" name="to_number" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Initiate Call
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
