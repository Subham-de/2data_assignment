<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>frm_html</title>
    <script src="./jquery.min.js"></script>
</head>
<body>
    <h2>Account/Client</h2>
    <button><a href="addcompany.php">Add Company</a></button>
    <button><a href="show.php">Show data</a></button>
    <select name="selectedCompany" id="selectedCompany">
        <?php
         include('conn.php');
         $sql = "SELECT id, name FROM accounts"; 
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
                 echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>"; 
             }
         }
        ?>
    </select>
    <form method="post" id="form_data" action="save_accounts.php">
        <!-- hidden id -->
        <input type="hidden" id="selectedId" name="companyId" value="">
        <div>
            <label for="name">Name</label>
            <input type="text" placeholder="enter your name" name="name" id="name"  style="margin-top: 10px;">
        </div>
        <div>
            <label for="email">email</label>
            <input type="text" placeholder="enter your mail" name="email" id="email"  style="margin-top: 10px;"> 
        </div>
        <div>
            <label for="gender">Gender : </label>
            <input type="radio" id="male" value="male" name="gender" checked>
            <label for="male">male</label>
            <input type="radio" id="female" value="female" name="gender"  style="margin-top: 10px;">
            <label for="female">female</label>
        </div>
        <div>
            <label for="contact">contact</label>
            <input type="number" id="phone" name="phone" placeholder="enter your number"  style="margin-top: 10px;">
        </div>
        <div>
            <label for="date">date</label>
            <input type="date" id="date" name="date"  style="margin-top: 10px;">
        </div>
        <button type="submit" style="margin-top: 10px;">Add data</button>
    </form>
    
</body>
</html>