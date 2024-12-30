@extends(backpack_view('blank'))

@section('content')
    <div class="container">
        <form action="{{ route('car.bookings.filter') }}" method="GET">
            <div class="row">
                <!-- Users Dropdown -->
                <div class="col-md-4">
                    <label for="user">Select User</label>
                    <select name="user" id="user" class="form-control">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request()->user == $user->id ? 'selected' : '' }}>{{ $user->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Available Cars Dropdown -->
                <div class="col-md-4">
                    <label for="car">Select Car</label>
                    <select name="car" id="car" class="form-control" disabled>
                        <option value="">Select a user first</option>
                    </select>
                    <div id="spinner" style="display: none;">
                        <img src="https://cdnjs.cloudflare.com/ajax/libs/Spin.js/2.3.2/spin.min.js" alt="loading..." />
                    </div>
                </div>

                <!-- Date Range Picker -->
                <div class="col-md-4">
                    <label for="date_range">Select Date Range</label>
                    <input type="text" name="date_range" id="date_range" class="form-control" value="{{ request()->date_range }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Filter</button>
        </form>

        @if(isset($bookings))
            <h3 class="mt-5">Filtered Bookings</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Car</th>
                    <th>Employee</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->car->model }} - {{ $booking->car->license_plate }}</td>
                        <td>{{ $booking->userProfile->name }}</td>
                        <td>{{ $booking->start_time }}</td>
                        <td>{{ $booking->end_time }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

@section('after_styles')
    <!-- Include the daterangepicker CSS -->
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet">
@endsection

@section('after_scripts')
    <!-- Include the jQuery and daterangepicker JS -->

    <script>
        $(document).ready(function () {
            console.log(userId)

            $('#date_range').daterangepicker({
                locale: { format: 'YYYY-MM-DD' },
                startDate: '{{ request()->date_range ? explode(' - ', request()->date_range)[0] : '' }}',
                endDate: '{{ request()->date_range ? explode(' - ', request()->date_range)[1] : '' }}',
            });

            $('#user').change(function() {
                var userId = $(this).val();
                var carDropdown = $('#car');
                var spinner = $('#spinner');

                spinner.show();
                carDropdown.prop('disabled', true);
                $.ajax({
                    url: "{{ route('car.bookings.filter') }}",
                    data: { user: userId },
                    success: function(response) {
                        spinner.hide();

                        carDropdown.prop('disabled', false);
                        carDropdown.empty();  // Clear existing options

                        carDropdown.append('<option value="">Select Car</option>');

                        response.cars.forEach(function(car) {
                            carDropdown.append('<option value="' + car.id + '">' + car.model + ' - ' + car.license_plate + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
