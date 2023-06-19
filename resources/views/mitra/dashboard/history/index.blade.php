@extends('mitra.dashboard.layouts.main')
@section('title', 'SquareFeed')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Partner List</h1> --}}

        <!-- DataTales Example -->
        <div class="card border-0 shadow mb-4">
            <div class="card-header py-3">
                <div class="btn btn-primary btn-sm px-4 border-0 shadow-sm">Add</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                use Faker\Factory as Faker;
                                
                                $faker = Faker::create('id_ID');
                                for ($i = 1; $i <= 100; $i++) {
                                    $randomId = random_int(1, 5);
                                    $status = ['Finished', 'in Progress', 'Canceled'];

                                    echo '<tr>';
                                        echo "<td>$randomId</td>";
                                        echo "<td>$faker->username</td>";
                                        echo '<td>' . $status[array_rand($status)] . '</td>';
                                        
                                    echo '</tr>';
                                }
                            @endphp
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
