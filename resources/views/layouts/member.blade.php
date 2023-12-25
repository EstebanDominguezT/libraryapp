<div class="container">
    <h1 class="text-center">Dashboard</h1>
    <hr>
    <div class="row mt-4">
        <div class="col-md-6">
            <h2 class="text-center">Books Borrowed</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Borrowed Date</th>
                        <th>Due Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowedBooks as $borrowed)
                        <tr>
                            <td>{{ $borrowed->book_isbn }} - {{ $borrowed->book_title }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($borrowed->borrowed_at)->format('Y-m-d') }}</td>
                            <td>{{ $borrowed->due_at }}</td>
                            <td>{{ (\Illuminate\Support\Carbon::parse($borrowed->due_at)->format('Y-m-d') < \Illuminate\Support\Carbon::now()->format('Y-m-d')) ? 'Overdue' : 'Not Overdue' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No books borrowed</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h2 class="text-center">Overdue Books</h2>
            <canvas id="overdueBooksChart" width="200" height="200"></canvas>
        </div>
    </div>
</div>

<script>
    var ctx = document.getElementById('overdueBooksChart').getContext('2d');
    var relationOverdueChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Overdue', 'Not Overdue'],
            datasets: [{
                data: [
                    {{ $relationOverdueBooks['overdue'] }},
                    {{ $relationOverdueBooks['NotOverdue'] }}
                ],
                backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(75, 192, 192, 0.6)'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            width: 200,
        }
    });
</script>