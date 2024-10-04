<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Transaction</title>
</head>
<body>
    <h2>Add Transaction</h2>
    <form action="/public/index.php?view=transaction/create" method="post">
        <label for="category_id">Category:</label>
        <input type="text" name="category_id" required><br>
        <label for="amount">Amount:</label>
        <input type="number" name="amount" required><br>
        <label for="date">Date:</label>
        <input type="date" name="date" required><br>
        <label for="description">Description:</label>
        <input type="text" name="description"><br>
        <button type="submit">Add</button>
    </form>
</body>
</html>
