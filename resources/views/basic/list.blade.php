@extends('basic.layout.app')
@section('content')
    <div class="container">
        <a href="{{ route('logout') }}" class="href">logout</a>
        <table class="table">
            <form action="" method="get">
                <input type="text" value="{{ Request::get('search') }}" id="search" name="search"
                    placeholder="Search by name">

                <select name="date_filter">
                    <option value="">Select Date Filter</option>
                    <option value="today" {{ Request::get('date_filter') == 'today' ? 'selected' : '' }}>Today</option>
                    <option value="yesterday" {{ Request::get('date_filter') == 'yesterday' ? 'selected' : '' }}>Yesterday
                    </option>
                    <option value="this_week" {{ Request::get('date_filter') == 'this_week' ? 'selected' : '' }}>This Week
                    </option>
                    <option value="last_week" {{ Request::get('date_filter') == 'last_week' ? 'selected' : '' }}>Last Week
                    </option>
                    <option value="this_month" {{ Request::get('date_filter') == 'this_month' ? 'selected' : '' }}>This
                        Month</option>
                    <option value="last_month" {{ Request::get('date_filter') == 'last_month' ? 'selected' : '' }}>Last
                        Month</option>
                    <option value="this_year" {{ Request::get('date_filter') == 'this_year' ? 'selected' : '' }}>This Year
                    </option>
                    <option value="last_year" {{ Request::get('date_filter') == 'last_year' ? 'selected' : '' }}>Last Year
                    </option>
                </select>

                <button type="submit">Filter</button>
                <a href="{{ route('show') }}" class="btn btn-secondary">Reset</a>
            </form>
            <thead>
                <tr>
                    <th scope="col">Sl No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Age</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Language</th>
                    <th scope="col">Image</th>
                    <th scope="col">Join Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($data->isNotEmpty())
                    @php
                        $i = ($data->currentpage() - 1) * $data->perpage();
                        $i = $i + 1;
                    @endphp
                    @foreach ($data as $date)
                        @php
                            $image = $date->image->first();
                        @endphp
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $date->fname }} {{ $date->lname }}</td>
                            <td>{{ $date->email }}</td>
                            <td>{{ $date->age }}</td>
                            <td>{{ $date->phone }}</td>
                            <td>{{ $date->gender }}</td>
                            <td>{{ implode(',', $date->description->toArray()) }}</td>
                            @if (!empty($image->name))
                                <td><img src="{{ asset('/basic/' . $image->name) }}" alt="" width="50px"></td>
                            @else
                                <td>No image</td>
                            @endif
                            <td>{{ $date->created_at->format('d-m-Y') }}</td>     
                            <td><a href="{{ route('edit', [$date->id]) }}" class="btn btn-warning">Edit</a>
                                <button class="btn btn-danger" onclick="deleteRecord({{ $date->id }})">Delete</button>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
@endsection

@section('script')
    <script>
        function deleteRecord(id) {
            $.ajax({
                url: `{{ url('/basic/delete') }}/${id}`,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                }
            })
        }
    </script>
@endsection
