<div class="container">
    <h1>Dashboard</h1>
    <hr>
    <h2 class="text-center">Books Statistics</h2>
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <canvas id="booksChart" width="200" height="400"></canvas>
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <ul>
                <li>Total Books: {{ $totalBooks }}</li>
                <li>Total Borrowed Books: {{ $totalBorrowedBooks }}</li>
                <li>Books Due Today: {{ $booksDueToday }}</li>
            </ul>
        </div>
    </div>
    <hr>
    <h2 class="text-center">Members with Overdue Books</h2>
    <div class="row mt-4">
        <div class="col-md-6">
            <canvas id="overdueBooksChart" width="400" height="400"></canvas>
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <th>Member Name</th>
                        <th>Overdue Books Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($membersWithOverdueBooks as $member)
                        <tr>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->overdueBooksCount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var ctx = document.getElementById('booksChart').getContext('2d');
    var booksChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total Books', 'Total Borrowed Books', 'Books Due Today'],
            datasets: [{
                label: 'Books Statistics',
                data: [{{ $totalBooks }}, {{ $totalBorrowedBooks }}, {{ $booksDueToday }}],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 255, 0, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 255, 0, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            height: 600,
            width: 800,
        }
    });

    var ctxPie = document.getElementById('overdueBooksChart').getContext('2d');
    var overdueBooksChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: @json($membersWithOverdueBooks->pluck('name')),
            datasets: [{
                data: @json($membersWithOverdueBooks->pluck('overdueBooksCount')),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(255, 205, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                ],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            height: 600,
            width: 600,
        }
    });
</script>