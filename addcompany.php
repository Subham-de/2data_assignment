<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addcompany</title>
</head>
<body>
    <h2>Add company</h2>
    <form method="post" action="save_company.php" id="form_account">
        <div>
            <label for="name">Company Name</label>
            <input type="text" name="company_name" id="company_name" placeholder="enter company name" style="margin-top: 10px;">
        </div>
        <div>
            <label for="date">Date</label>
            <input type="date" id="date" name="date" style="margin-top: 10px;">
        </div>
        <button style="margin-top: 10px;">Add company</button>
    </form>
</body>
</html>