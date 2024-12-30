@extends(backpack_view('blank'))

@section('content')
    <div class="container">
        <form action="{{ route('car.bookings.filter') }}" method="GET">
            <div class="row">
                <div class="col-md-6">
                    <label for="user">Select User</label>
                    <select name="user" id="user" class="form-control">
                        <option value="">Select user</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request()->user == $user->id ? 'selected' : '' }}>{{ $user->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3" id="start-date-container" >
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request()->start_date }}">
                </div>
                <div class="col-md-3" id="end-date-container">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request()->end_date }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Filter</button>
        </form>

        @if(isset($availableCars) && sizeof($availableCars) > 0)
            <h3 class="mt-5">Available Cars</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Car Model</th>
                    <th>License Plate</th>
                    <th>Comfort Category</th>
                </tr>
                </thead>
                <tbody>
                @foreach($availableCars as $car)
{{--                    {{dd($availableCars)}}--}}
                    <tr>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->license_plate }}</td>
                        <td>{{ $car->comfortCategory->name?? 'N/A' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-5">No available cars for the selected filters.</p>
        @endif

    </div>
@endsection

@section('after_scripts')
    <script>
        $(document).ready(function () {
            $('#user').change(function () {
                var userId = $(this).val();
                if (userId) {
                } else {
                    $('#start_date').val('');
                    $('#end_date').val('');
                }
            });
        });
    </script>
@endsection
