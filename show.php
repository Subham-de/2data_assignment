<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <h2>Data Overview</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Total Records</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('conn.php');

                $sql = "SELECT a.name AS company_name, COUNT(ad.id) AS total_records 
                        FROM accounts a 
                        INNER JOIN account_details ad ON a.id = ad.account_id 
                        GROUP BY a.name";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['company_name'] . "</td>";
                        echo "<td>" . $row['total_records'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No data available</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <div class="mt-3 mb-3">
            <input type="search" placeholder="search here.." id="search" name="search" class="form-control w-25">
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th><button id="name" class="btn btn-primary sort-btn" data-column='email' data-order='asc'><span class="bi bi-chevron-expand"></span></button> &nbsp; Name</th>
                    <th><button id="clientname" class="btn btn-primary sort-btn" data-column='email' data-order='asc'><span class="bi bi-chevron-expand"></span></button> &nbsp; Client Name</th>
                    <th><button id="email" class="btn btn-primary sort-btn" data-column='email' data-order='asc'><span class="bi bi-chevron-expand"></span></button> &nbsp; Email</th>
                    <th><button id="gender" class="btn btn-primary sort-btn" data-column='gender' data-order='asc'><span class="bi bi-chevron-expand"></span></button> &nbsp; Gender</th>
                    <th><button id="contact" class="btn btn-primary sort-btn" data-column='email' data-order='asc'><span class="bi bi-chevron-expand"></span></button> &nbsp; Contact</th>
                    <th><button class="btn btn-primary sort-btn" data-column='date' data-order='asc'><span class="bi bi-chevron-expand"></span></button> &nbsp; Date</th>
                    <th colspan="2" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="table_filter">
                <?php
                include('conn.php');
                                                                                        
                $sql = "SELECT   a.name AS company_name, ad.id AS id, ad.name AS client_name, ad.email, ad.gender, ad.contact, ad.date 
                        FROM accounts a 
                        INNER JOIN account_details ad ON a.id = ad.account_id 
                        ORDER BY a.name";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>" . $row["company_name"] . "</td>
                        <td>" . $row["client_name"] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row["gender"] . "</td>
                        <td>" . $row['contact'] . "</td>
                        <td>" . $row['date'] . "</td>
                        <td><a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a></td>
                        <td><a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are u sure to delete?\")' class='btn btn-danger'>delete</a></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data available</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-primary mb-2">Back to Home</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function searchdata() {
                var search_text = $('#search').val();
                $.ajax({
                    url: 'search.php',
                    method: 'get',
                    data: {
                        search: search_text,
                    },
                    success: function(data) {
                        $("#table_filter").html(data)
                    }
                })
            }
            $("#search").on('keypress', function(e) {
                if (e.which == 13) {
                    e.preventDefault();
                    searchdata();
                    $("#search").val('')
                }
            })

            //sorting data
            $(".sort-btn").click(function(e) {
                e.preventDefault();
                var column_name_id = $(this).attr('id')
                var $this = $(this);
                var column = $this.data('column');
                var order = $this.data('order');

                // Toggle sort order for next click
                var newOrder = order === 'asc' ? 'desc' : 'asc';
                $this.data('order', newOrder);

                $.ajax({
                    url: 'sort.php',
                    method: 'GET',
                    data: {
                        order: order,
                        column: column
                    },
                    success: function(data) {
                        $("#table_filter").html(data);

                        // Remove arrows from all buttons
                        $('.sort-btn').find('span').remove();

                        // Add arrow to the sorted column button
                        var arrow = order === 'asc' ? '<span class="bi bi-chevron-up"></span>' : '<span class="bi bi-chevron-down"></span>';
                        $("#" + column_name_id).append(arrow);

                        // Add expand icon to all other buttons
                        $('.sort-btn').not("#" + column_name_id).append('<span class="bi bi-chevron-expand"></span>');
                    }
                });
            })
        })
    </script>
</body>

</html>

